@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
   <x-layout >
    <x-alerts.success />
    <div class="container">
        <div>
            <h2>
                User List
            </h2>
        </div>
        <!-- personally crated template for table -->
        <!-- <x-tables.listTable :tableHead='["ID", "Name", "Email", "Role"]' :datas='$userData'/> -->

        
        <x-adminlte-datatable head-theme="light" theme="warning" id="table1" :heads='["ID", "Name", "Email", "Role"]' with-buttons>
            @foreach($userData as $row)
                    @php
                        $keys = array_keys($row->toArray());
                    @endphp
                <tr>
                    @foreach($keys as $cell)
                        <td>{!! $row[$cell] !!}</td>
                    @endforeach
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </div>
</x-layout>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        let logOut = `
            <form method="post" action="{{ route('logout') }}" class="text-center">
                @csrf
                <x-adminlte-button type="submit" label="Log out" theme="danger" icon="fa-solid fa-arrow-right-from-bracket"/>
            </form>
            `;

        let profile = `
            <x-adminlte-profile-widget name="Robert Gleeis" desc="Sound Manager" theme="warning"
                    <x-adminlte-profile-widget name="{{ ucfirst(auth()->user()->firstName . ' ' . auth()->user()->lastName ) }}" desc="{{ auth()->user()->role }}" theme="dark"
                img="{{ asset('storage/img/'. auth()->user()->image) }}">
                <x-adminlte-profile-col-item class="text-primary border-right" icon="fas fa-lg fa-gift"
                    title="Sales" text="25" size=6 badge="primary"/>
                <x-adminlte-profile-col-item class="text-danger" icon="fas fa-lg fa-users" title="Dependents"
                    text="10" size=6 badge="danger"/>
            </x-adminlte-profile-widget>
            `;
        $( ".brand-link" ).replaceWith('<div class="col-md-12">'+profile+'</div>');
        $('ul.nav-pills').append('<li>'+logOut+'</li>');
       
    </script>
@stop
