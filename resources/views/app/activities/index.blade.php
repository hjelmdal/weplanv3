<?php
/**
 * Created by PhpStorm.
 * User: impact
 * Date: 2019-03-30
 * Time: 16:50
 */

?>
@extends("layouts.theme.index")
@section("scripts")


@endsection
@section("styles")

@endsection
@section("content")
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">Striped Rows</h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin::Section-->
            <div class="kt-section">
                <div class="kt-section__content">
                    <table class="table table-striped m-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($activities as $activity)
                        <tr>
                            <th scope="row">{{ $activity->id }}</th>
                            <td>{{ $activity->title }}</td>
                            <td>{{ $activity->start }}</td>
                            <td>{{ $activity->end }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <th scope="row">2</th>
                            <td>Lisa</td>
                            <td>Nilson</td>
                            <td>@lisa</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--end::Section-->
        </div>
        <!--end::Form-->
    </div>
@endsection
