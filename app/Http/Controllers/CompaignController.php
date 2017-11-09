<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\CompaignForm;
use Doctrine\ORM\EntityManagerInterface;
use App\Entities\Campaign;

class CompaignController extends Controller
{

    protected $em;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EntityManagerInterface  $em)
    {
        $this->em = $em;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = $this->em->getRepository(\App\Entities\Campaign::class)->findAll();
        return view('campaign.list', ['companies' => $companies]);
    }

    public function create(FormBuilder $formBuilder)
    {
        if(Auth::user()->getRoles() != 'ROLE_ADMIN'){
            return response()->view('errors.not-permission', [], 500);
        }
        $form = $formBuilder->create(CompaignForm::class, [
            'method' => 'POST',
            'name' => 'App\Entities\Compaign',
            'url' => route('campaign.store')
        ]);

        return view('campaign.create', compact('form'));
    }

    public function store(FormBuilder $formBuilder)
    {
        if(Auth::user()->getRoles() != 'ROLE_ADMIN'){
            return response()->view('errors.not-permission', [], 500);
        }
        $form = $formBuilder->create(CompaignForm::class, ['name' => 'App\Entities\Compaign']);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = $form->getRequest()->get('app_compaign');
        $this->em->getRepository('App\Entities\Campaign')->save($data);
        \Session::flash('msg', 'save success');
        return redirect( 'compaign');

    }
}
