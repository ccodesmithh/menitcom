@extends('layouts.admin')

@section('content')
<div class="container-fluid">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Selamat Datang, {{Auth::user()->name}}</li>
            </ol>
              <div class="row mt-4">

        <div class="col-md-4">

            <div class="card text-bg-secondary mb-3">

                <div class="card-body">

                    <h5 class="card-title">Total Berita Terbaru Hari ini</h5>

                    <p class="fs-4">{{ $berita->count() }}</p>

                </div>

            </div>

        </div>

    </div>
            <!-- <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                        </thead>
                        </table>
                </div>
            </div> -->
        </div>
@endsection