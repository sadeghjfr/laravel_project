@extends('admin.layouts.master')

@section('head-tag')
    <title>دسته بندی تیکت ها</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش تیکت ها</a></li>
            <li class="breadcrumb-item font-size-12"> دسته بندی تیکت ها</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">

                @include('admin.alerts.alert-section.success')

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.ticket.category.create') }}" class="btn btn-info btn-sm">ایجاد دسته بندی</a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام دسته بندی</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($ticketCategories as $key => $ticketCategory)

                            <tr>
                                <th>{{ $key += 1 }}</th>
                                <td>{{ $ticketCategory->name }}</td>
                                <td>
                                    <label>
                                        <input id="{{ $ticketCategory->id }}" onchange="changeStatus({{ $ticketCategory->id }})" data-url="{{ route('admin.ticket.category.status', $ticketCategory->id) }}" type="checkbox" @if ($ticketCategory->status === 1)
                                            checked
                                            @endif>
                                    </label>
                                </td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.ticket.category.edit', $ticketCategory->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <form class="d-inline" action="{{ route('admin.ticket.category.destroy', $ticketCategory->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>
                                    </form>
                                </td>
                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                </section>

            </section>
        </section>
    </section>

@endsection

@section('script')

    @include('admin.scripts.status-control')
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])

@endsection
