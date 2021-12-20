@extends('master-admin')
@section('title', 'E Health Care - Dashboard')

@section('content')
    <div id="wrapper">
        @include('admin/nav')
        <div id="page-wrapper" class="gray-bg dashbard-1">
            @include('shared.top-nav')
            <div class="row">
                <div class="col-lg-4">
                    <div class="widget-head-color-box navy-bg p-lg text-center">
                        <div class="m-b-md">
                            <h2 class="font-bold no-margins">
                                Alex Smith
                            </h2>
                            <small>Founder of Groupeq</small>
                        </div>
                        <img src="img/a4.jpg" class="rounded-circle circle-border m-b-md" alt="profile">
                        <div>
                            <span>100 Tweets</span> |
                            <span>350 Following</span> |
                            <span>610 Followers</span>
                        </div>
                    </div>
                    <div class="widget-text-box">
                        <h4 class="media-heading">Alex Smith</h4>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <div class="text-right">
                            <a href="" class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                            <a href="" class="btn btn-xs btn-primary"><i class="fa fa-heart"></i> Love</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div>
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-danger m-r-sm">12</button>
                                    Total messages
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary m-r-sm">28</button>
                                    Posts
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info m-r-sm">15</button>
                                    Comments
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-success m-r-sm">40</button>
                                    Likes
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info m-r-sm">40</button>
                                    Reviews
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
