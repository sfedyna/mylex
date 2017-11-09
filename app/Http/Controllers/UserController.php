<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Mail;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entities\InvitedClients;
use App\Entities\Voucher;

class UserController extends Controller
{
    protected $em;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->middleware('auth');
    }

    public function index()
    {
        $companies = [];
        $arrInvitedClients = $this->em->getRepository(\App\Entities\InvitedClients::class)->findBy(['user' => Auth::user(), 'status' => 1]);
        if (count($arrInvitedClients) >= 2) {
            $companies = $this->em->getRepository(\App\Entities\Campaign::class)->findBy(['type' => 'referral']);
        };
        return view('user.index', ['companies' => $companies]);
    }

    public function generateVoucher(Request $request)
    {
        if ($id = $request->get('id')) {
            $compaign = $this->em->getRepository(\App\Entities\Campaign::class)->find($id);
            $stripe = Stripe::make(config('services.stripe.secret'));
            $coupon = $stripe->coupons()->create([
                'duration' => $compaign->getVoucherDuration(),
                'percent_off' => $compaign->getVoucherPercentOff(),
                'currency' => $compaign->getVoucherCurrency(),
            ]);
            if (!$code = $coupon['id']) {
                \Session::flash('msg-error', 'Error: while trying to generate coupon. Please try again.');
                return redirect('/');
            }
            $newVoucher = new Voucher();
            $newVoucher->setCode($code);
            $newVoucher->setUser(Auth::user());
            $newVoucher->setCampaign($compaign);
            $this->em->persist($newVoucher);
            $this->em->flush();
            if ($this->em->getRepository(InvitedClients::class)->updateStatus(Auth::user()->getId(), 2)) {
                \Session::flash("msg-success", "Voucher is created successfully: {$code}");
            }
        }
        return redirect('/');
    }

    public function inviteClient(Request $request)
    {
        $error = false;
        $email = $request->get('email');
        if (!($email && filter_var($request->get('email'), FILTER_VALIDATE_EMAIL))
        ) {
            $error = 'Incorrect email adress';
        }
        if ($this->em->getRepository(InvitedClients::class)->findOneBy(['emailClient' => $email]) ||
            $this->em->getRepository(\App\Entities\User::class)->findOneBy(['email' => $email])
        ) {
            $error = 'This email address is already existing';
        }
        if (!$error) {
            $newInviteClient = new InvitedClients();
            $newInviteClient->setUser(Auth::user());
            $newInviteClient->setEmailClient($email);
            $this->em->persist($newInviteClient);
            $this->em->flush();
            $link = URL("/register?type=client&email={$email}");
            Mail::send('mail.invite-client', ['title' => 'Test Assignment', 'link' => $link], function ($message) use ($email) {
                $message->from('slfedyna@gmail.com', 'Test Assignment');
                $message->to($email);
                $message->subject('Test Assignmen');

            });
            $response = array(
                'status' => 'success',
                'message' => 'Invite  sent successfully'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => $error
            );
        }
        return \Response::json($response);
    }
}