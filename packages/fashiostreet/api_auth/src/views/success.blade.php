@extends('api_auth::layout.mainlayout')
@section('title','fashiostreet register')
@section('content')

                <form class="white" action="/createshop">
                    <center><img src="{{ asset('assets/img/fashiostreet-icon.png') }}" style="width:80px"/>
                        <h2>Fashio<span class="green">street</span></h2>
                        <img src="{{ asset('assets/img/fashiostreet-check-mark.png') }}"/>
                        <h3>Successfully account created</h3>
                    </center><br/>
                    <button type="submit" class="btn btn-fashio primary-black"><img src="{{ asset('assets/img/store.png') }}"/> Click here to create shop</button>
                </form><br/>

@endsection