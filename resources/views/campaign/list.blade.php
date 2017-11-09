@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default create-company">
                    <div class="panel-heading">Companies</div>
                    <div class="panel-body">
                        @if (count($companies) > 0)
                            <h3>List Companies</h3>
                            @if (\Session::has('msg'))
                                <div class="alert alert-success">
                                    {{ \Session::get('msg') }}
                                </div>
                            @endif
                            <div class="company-list">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Company</th>
                                        <th>Type</th>
                                    </tr>
                                    </thead>
                                    @foreach ($companies as $company)
                                        <tr>
                                            <td>{{ $company->getId() }}</td>
                                            <td>{{ $company->getName() }}</td>
                                            <td>{{ $company->getType() }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        @endif
                        @if (Auth::user()->getRoles() == 'ROLE_ADMIN')
                        <a href="{{ URL::route('campaign.create') }}">
                            Create new campaign
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
