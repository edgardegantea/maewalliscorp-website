<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PartnerModel;
use App\Models\SupportTicketModel;
use CodeIgniter\HTTP\RedirectResponse;

class TicketsController extends BaseController
{
    public function index(): string
    {
        $model  = new SupportTicketModel();
        $status = $this->request->getGet('status');

        $query = $model->orderBy('created_at', 'DESC');
        if ($status && in_array($status, SupportTicketModel::STATUSES, true)) {
            $query = $query->where('status', $status);
        }

        return view('admin/layouts/main', [
            'title'   => 'Tickets de soporte',
            'content' => view('admin/tickets/index', [
                'items'         => $query->findAll(),
                'activeStatus'  => $status,
                'partnersByIdx' => $this->partnersById(),
            ]),
        ]);
    }

    public function show(int $id): string
    {
        $ticket = (new SupportTicketModel())->find($id);

        return view('admin/layouts/main', [
            'title'   => 'Ticket ' . ($ticket['folio'] ?? ''),
            'content' => view('admin/tickets/show', [
                'ticket'   => $ticket,
                'partners' => (new PartnerModel())->getOrdered(),
            ]),
        ]);
    }

    public function update(int $id): RedirectResponse
    {
        $model  = new SupportTicketModel();
        $status = (string) $this->request->getPost('status');

        if (! in_array($status, SupportTicketModel::STATUSES, true)) {
            return redirect()->to('/admin/tickets/' . $id)->with('error', 'Estado inválido.');
        }

        $partnerId = $this->request->getPost('partner_id');

        $model->update($id, [
            'status'      => $status,
            'partner_id'  => $partnerId !== '' ? (int) $partnerId : null,
            'admin_notes' => trim((string) $this->request->getPost('admin_notes')),
        ]);

        return redirect()->to('/admin/tickets/' . $id)->with('success', 'Ticket actualizado.');
    }

    /** @return array<int, string> */
    private function partnersById(): array
    {
        $map = [];
        foreach ((new PartnerModel())->getOrdered() as $partner) {
            $map[$partner['id']] = $partner['name'];
        }

        return $map;
    }
}
