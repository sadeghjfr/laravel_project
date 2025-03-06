@extends('admin.layouts.master')

@section('head-tag')
    <title>نمایش تیکت</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش تیکت ها</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.ticket.index')}}"> تیکت ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نمایش تیکت</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">

                <section class="card mb-3">

                    <section class="d-flex justify-content-between align-items-center bg-custom-pink">
                        <section class="card-header text-white w-100">
                            {{$ticket->user->fullName}} - شناسه : {{$ticket->user->id}}
                        </section>
                        <a href="{{ route('admin.ticket.index') }}" class="btn btn-info btn-sm ml-2">بازگشت</a>
                    </section>

                    <section class="card-body">
                        <h5 class="card-title">{{$ticket->subject}}</h5>
                        <p class="card-text">{{$ticket->description}}</p>
                    </section>
                </section>

                @foreach($ticket->children as $answerTicket)

                    <section class="card mb-3">

                        <section class="d-flex justify-content-between align-items-center bg-custom-light-green">
                            <section class="card-header text-white w-100">
                                {{$answerTicket->admin->user->fullName ?? '-'}} - شناسه : {{$answerTicket->admin->user->id ?? '-'}}
                            </section>
                        </section>

                        <section class="card-body">
                            <h5 class="card-title">{{$answerTicket->subject}}</h5>
                            <p class="card-text">{{$answerTicket->description}}</p>
                        </section>
                    </section>

                @endforeach

                @if($ticket->parent == null)

                <section>
                    <form action="{{ route('admin.ticket.answer', $ticket->id) }}" method="post">
                        @csrf
                        <section class="row">
                            <section class="col-12 mb-2">
                                <div class="form-group mb-1">
                                    <label for="description">پاسخ تیکت </label>
                                    <textarea name="description" class="form-control form-control-sm" rows="4">{{old('description')}}</textarea>
                                </div>
                                @error('description')
                                <span class="text-danger" role="alert">
                                    <strong>
                                        {{$message}}
                                    </strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 mt-4">
                            <button class="btn btn-primary w-100">ثبت نهایی</button>
                        </section>
                        </section>
                    </form>
                </section>

                @endif

            </section>
        </section>
    </section>

@endsection
