<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function contact()
    {
        return view('site.pages.contact.index');
    }

    public function sitemap()
    {
        return view('site.pages.sitemap.index');
    }

    public function deliveryInfo()
    {
        return view('site.pages.company.delivery_info');
    }

    public function legalNotice()
    {
        return view('site.pages.company.legal_notice');
    }

    public function termsConditions()
    {
        return view('site.pages.company.terms_conditions');
    }

    public function aboutUs()
    {
        return view('site.pages.company.about_us');
    }

    public function securePayment()
    {
        return view('site.pages.company.secure_payment');
    }

    public function returns()
    {
        return view('site.pages.services.returns');
    }

    public function faq()
    {
        return view('site.pages.services.faq');
    }

    public function shipping()
    {
        return view('site.pages.services.shipping');
    }

    public function warranty()
    {
        return view('site.pages.services.warranty');
    }

    public function giftCards()
    {
        return view('site.pages.services.gift_cards');
    }
}
