<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class CompaignForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', [
                'rules' => 'required|min:5'
            ])
            ->add('period', 'date')
            ->add('type', 'select', [
                'choices' => ['referral' => 'Referral'],
                'empty_value' => '=== Select Type ==='
            ])
            ->add('voucherDuration', 'select', [
                'choices' => ['forever' => 'Forever', 'once' => 'Once', 'repeating' => 'Repeating'],
                'empty_value' => '=== Select Type ==='

            ])
            ->add('voucherPercentOff', 'number', ['label' => 'Discount ', ['rules' => 'required|min:0|max:100']])
            ->add('voucherCurrency', 'text', ['rules' => 'required|min:2|max:3'])
            ->add('submit', 'submit')
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_compaign';
    }
}
