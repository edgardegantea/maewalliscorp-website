<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ContactMessageModel;
use App\Models\PartnerModel;
use App\Models\PortfolioItemModel;
use App\Models\ServiceModel;

class DashboardController extends BaseController
{
    public function index(): string
    {
        $data = [
            'title'          => 'Dashboard',
            'messagesCount'  => (new ContactMessageModel())->countAllResults(),
            'servicesCount'  => (new ServiceModel())->countAllResults(),
            'portfolioCount' => (new PortfolioItemModel())->countAllResults(),
            'partnersCount'  => (new PartnerModel())->countAllResults(),
            'adminName'      => session()->get('admin_user_name'),
        ];

        return view('admin/layouts/main', [
            'title'   => $data['title'],
            'content' => view('admin/dashboard', $data),
        ]);
    }
}
