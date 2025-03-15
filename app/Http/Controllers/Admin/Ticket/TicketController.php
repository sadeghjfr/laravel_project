<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketRequest;
use App\Models\Admin\Ticket\Ticket;
use Illuminate\Support\Facades\Redirect;

class TicketController extends Controller
{

    public function index()
    {
        $newTickets = Ticket::where('status', 'new')->get();
        $openTickets = Ticket::where('status', 'open')->get();
        $closeTickets = Ticket::where('status', 'close')->get();

        return view('admin.ticket.index', compact('newTickets', 'openTickets', 'closeTickets'));
    }

    public function show(Ticket $ticket)
    {

        if ($ticket->status == 'new'){
            $ticket->status = 'open';
            $ticket->save();
        }

        return view('admin.ticket.show', compact('ticket'));
    }

    public function status(Ticket $ticket)
    {

        $ticket->status = $ticket->status == 'open' ? 'close' : 'open';
        $ticket->save();
        return Redirect::back()->with('toast-success', 'تغییرات با موفقیت اعمال شد');
    }

    public function answer(TicketRequest $request, Ticket $ticket)
    {

        $inputs = $request->all();
        $inputs['subject'] = 'پاسخ به : ' . $ticket->subject;
        $inputs['description'] = $request->description;
        $inputs['status'] = 'answer';
        $inputs['reference_id'] = $ticket->reference_id;
        $inputs['user_id'] = $ticket->user_id;
        $inputs['category_id'] = $ticket->category_id;
        $inputs['priority_id'] = $ticket->priority_id;
        $inputs['ticket_id'] = $ticket->id;

        $result = Ticket::create($inputs);
        return redirect()->route('admin.ticket.index')->with('swal-success', 'پاسخ تیکت با موفقیت ثبت شد');
    }


    public function destroy(Ticket $ticket){
        $result = $ticket->delete();
        return redirect()->route('admin.ticket.index')->with('swal-success', 'تیکت با موفقیت حذف شد');
    }

    //public function create(){}

    //public function store(Request $request){}

    //public function edit($id){}

    //public function update(Request $request, $id){}
}
