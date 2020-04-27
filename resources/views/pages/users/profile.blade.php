@extends('layouts.master')
@section('content')
<style>
    
    .profile__banner {
        background-color: rgba(70, 156, 64, 0.9) !important;
    }

</style>
<!-- Profile -->
<div class="profile">

    <!-- Profile Banner -->
    <div class="profile__banner">

        <!-- Profile Banner Top -->
        <div class="profile__banner-detail">
            <!-- Avatar Wrapper -->
            <div class="dt-avatar-wrapper">
                <!-- Avatar -->
                <img class="dt-avatar dt-avatar__shadow size-90 mr-sm-4"
                     src="{{ $staff->avatar !== null ? asset('images/staffs/'.$staff->avatar) : 'https://via.placeholder.com/300x300' }}" alt="Reece Jacklin">
                <!-- /avatar -->

                <!-- Info -->
                <div class="dt-avatar-info">
                    <span class="dt-avatar-name display-4 mb-2 font-weight-light">{{ $staff->name }}</span>
                    <span class="f-16">{{ $staff->location ?? 'NCDMB' }}</span>
                </div>
                <!-- /info -->
            </div>
            <!-- /avatar wrapper -->

            <div class="ml-sm-auto">
                <!-- List -->
                <ul class="dt-list dt-list-bordered dt-list-col-4">
                    <!-- List Item -->
                    <li class="dt-list__item text-center">
                        <span class="h4 font-weight-500 mb-0 text-white">2k+</span>
                        <span class="d-block f-12">Ranking</span>
                    </li>
                    <!-- /list item -->
                    <!-- List Item -->
                    <li class="dt-list__item text-center">
                        <span class="h4 font-weight-500 mb-0 text-white">847</span>
                        <span class="d-block f-12">Tasks</span>
                    </li>
                    <!-- /list item -->
                    <!-- List Item -->
                    <li class="dt-list__item text-center">
                        <span class="h4 font-weight-500 mb-0 text-white">324</span>
                        <span class="d-block f-12">Completed</span>
                    </li>
                    <!-- /list item -->
                </ul>
                <!-- /list -->
            </div>
        </div>
        <!-- /profile banner top -->

    </div>
    <!-- /profile banner -->

    <!-- Profile Content -->
    <div class="profile-content">

        <!-- Grid -->
        <div class="row">

            <!-- Grid Item -->
            <div class="col-xl-4 order-xl-2">


                <!-- Grid -->
                <div class="row">

                    <!-- Grid Item -->
                    <div class="col-xl-12 col-md-6 col-12 order-xl-1">

                        <!-- Card -->
                        <div class="dt-card dt-card__full-height">

                            <!-- Card Header -->
                            <div class="dt-card__header pt-6">

                                <!-- Card Heading -->
                                <div class="dt-card__heading">
                                    <h3 class="dt-card__title">Contact</h3>
                                </div>
                                <!-- /card heading -->

                            </div>
                            <!-- /card header -->

                            <!-- Card Body -->
                            <div class="dt-card__body">
                                <!-- Media -->
                                <div class="media mb-5">

                                    <i class="icon icon-mail icon-xl mr-5"></i>

                                    <!-- Media Body -->
                                    <div class="media-body">
                                        <span class="d-block text-light-gray f-12 mb-1">Mail</span>
                                        <a href="javascript:void(0)">{{ $staff->email }}</a>
                                    </div>
                                    <!-- /media body -->

                                </div>
                                <!-- /media -->

                                <!-- Media -->
                                <div class="media mb-5">

                                    <i class="icon icon-link icon-xl mr-5"></i>

                                    <!-- Media Body -->
                                    <div class="media-body">
                                        <span class="d-block text-light-gray f-12 mb-1">Web Page</span>
                                        <a href="javascript:void(0)">ncdmb.gov.ng</a>
                                    </div>
                                    <!-- /media body -->

                                </div>
                                <!-- /media -->

                                <!-- Media -->
                                <div class="media">

                                    <i class="icon icon-phone-o icon-xl mr-5"></i>

                                    <!-- Media Body -->
                                    <div class="media-body">
                                        <span class="d-block text-light-gray f-12 mb-1">Phone</span>
                                        <span class="h5">{{ $staff->mobile ?? 'not set' }}</span>
                                    </div>
                                    <!-- /media body -->

                                </div>
                                <!-- /media -->
                            </div>
                            <!-- /card body -->

                        </div>
                        <!-- /card -->

                    </div>
                    <!-- /grid item -->

                </div>
                <!-- /grid -->

            </div>
            <!-- /grid item -->

            <!-- Grid Item -->
            <div class="col-xl-8 order-xl-1">

                <!-- Card -->
                <div class="card">

                    <!-- Card Header -->
                    <div class="card-header card-nav bg-transparent border-bottom d-sm-flex justify-content-sm-between">
                        <h3 class="mb-2 mb-sm-n5">About</h3>

                        <ul class="card-header-links nav nav-underline" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tab-pane1"
                                   role="tab"
                                   aria-controls="tab-pane1"
                                   aria-selected="true">Overview</a>
                            </li>
                        </ul>

                    </div>
                    <!-- /card header -->

                    <!-- Card Body -->
                    <div class="card-body pb-2">

                        <!-- Tab Content-->
                        <div class="tab-content mt-5">

                            <!-- Tab panel -->
                            <div id="tab-pane1" class="tab-pane active">

                                <!-- List -->
                                <ul class="dt-list dt-list-col-4">
                                    <!-- List Item -->
                                    <li class="dt-list__item">
                                        <!-- Media -->
                                        <div class="media">

                                            <i class="icon icon-company icon-4x mr-5 align-self-center text-yellow"></i>

                                            <!-- Media Body -->
                                            <div class="media-body">
                                                <span class="d-block text-light-gray f-12 mb-1">Works at</span>
                                                <p class="h5 mb-0">{{ $staff->department('dept') }}</p>
                                            </div>
                                            <!-- /media body -->

                                        </div>
                                        <!-- /media -->
                                    </li>
                                    <!-- /list item -->
                                </ul>
                                <!-- /list -->

                            </div>
                            <!-- /tab panel -->

                            <!-- Tab panel -->
                            <div id="tab-pane2" class="tab-pane">

                                <!-- List -->
                                <ul class="dt-list dt-list-col-4">
                                    <!-- List Item -->
                                    <li class="dt-list__item">
                                        <!-- Media -->
                                        <div class="media">

                                            <i class="icon icon-company icon-4x mr-5 align-self-center text-yellow"></i>

                                            <!-- Media Body -->
                                            <div class="media-body">
                                                <span class="d-block text-light-gray f-12 mb-1">Works at</span>
                                                <p class="h5 mb-0">G-axon Tech Pvt. Ltd.</p>
                                            </div>
                                            <!-- /media body -->

                                        </div>
                                        <!-- /media -->
                                    </li>
                                    <!-- /list item -->

                                    <!-- List Item -->
                                    <li class="dt-list__item">
                                        <!-- Media -->
                                        <div class="media">

                                            <i class="icon icon-birthday-new icon-4x mr-5 align-self-center text-yellow"></i>

                                            <!-- Media Body -->
                                            <div class="media-body">
                                                <span class="d-block text-light-gray f-12 mb-1">Birthday</span>
                                                <p class="h5 mb-0">Oct 25, 1984</p>
                                            </div>
                                            <!-- /media body -->

                                        </div>
                                        <!-- /media -->
                                    </li>
                                    <!-- /list item -->

                                    <!-- List Item -->
                                    <li class="dt-list__item">
                                        <!-- Media -->
                                        <div class="media">

                                            <i class="icon icon-graduation icon-4x mr-5 align-self-center text-yellow"></i>

                                            <!-- Media Body -->
                                            <div class="media-body">
                                                <span class="d-block text-light-gray f-12 mb-1">Went to</span>
                                                <p class="h5 mb-0">Oxford University</p>
                                            </div>
                                            <!-- /media body -->

                                        </div>
                                        <!-- /media -->
                                    </li>
                                    <!-- /list item -->

                                    <!-- List Item -->
                                    <li class="dt-list__item">
                                        <!-- Media -->
                                        <div class="media">

                                            <i class="icon icon-home icon-4x mr-5 align-self-center text-yellow"></i>

                                            <!-- Media Body -->
                                            <div class="media-body">
                                                <span class="d-block text-light-gray f-12 mb-1">Lives in London</span>
                                                <p class="h5 mb-0">From Switzerland</p>
                                            </div>
                                            <!-- /media body -->

                                        </div>
                                        <!-- /media -->
                                    </li>
                                    <!-- /list item -->

                                    <!-- List Item -->
                                    <li class="dt-list__item">
                                        <!-- Media -->
                                        <div class="media">

                                            <i class="icon icon-family icon-4x mr-5 align-self-center text-yellow"></i>

                                            <!-- Media Body -->
                                            <div class="media-body">
                                                <span class="d-block text-light-gray f-12 mb-1">4 Family Members</span>

                                                <!-- Project Team -->
                                                <ul class="dt-list dt-team-list dt-team-list-sm">
                                                    <li>
                                                        <!-- Avatar -->
                                                        <a class="dt-avatar size-25"
                                                           href="javascript:void(0)">
                                                            <img src="https://via.placeholder.com/150x150"
                                                                 alt="Steve Smith"> </a>
                                                        <!-- /avatar -->
                                                    </li>
                                                    <li>
                                                        <!-- Avatar -->
                                                        <a class="dt-avatar size-25"
                                                           href="javascript:void(0)">
                                                            <img src="https://via.placeholder.com/150x150"
                                                                 alt="Alex Dolgove"> </a>
                                                        <!-- /avatar -->
                                                    </li>
                                                    <li>
                                                        <!-- Avatar -->
                                                        <a class="dt-avatar size-25"
                                                           href="javascript:void(0)">
                                                            <img src="https://via.placeholder.com/150x150"
                                                                 alt="Reece Jacklin"> </a>
                                                        <!-- /avatar -->
                                                    </li>
                                                    <li>
                                                        <!-- Avatar -->
                                                        <a class="dt-avatar size-25"
                                                           href="javascript:void(0)">
                                                            <img src="https://via.placeholder.com/150x150"
                                                                 alt="Selena"> </a>
                                                        <!-- /avatar -->
                                                    </li>
                                                </ul>
                                                <!-- /project team -->

                                            </div>
                                            <!-- /media body -->

                                        </div>
                                        <!-- /media -->
                                    </li>
                                    <!-- /list item -->
                                </ul>
                                <!-- /list -->

                            </div>
                            <!-- /tab panel -->

                            <!-- Tab panel -->
                            <div id="tab-pane3" class="tab-pane">

                                <!-- List -->
                                <ul class="dt-list dt-list-col-4">
                                    <!-- List Item -->
                                    <li class="dt-list__item">
                                        <!-- Media -->
                                        <div class="media">

                                            <i class="icon icon-company icon-4x mr-5 align-self-center text-yellow"></i>

                                            <!-- Media Body -->
                                            <div class="media-body">
                                                <span class="d-block text-light-gray f-12 mb-1">Works at</span>
                                                <p class="h5 mb-0">G-axon Tech Pvt. Ltd.</p>
                                            </div>
                                            <!-- /media body -->

                                        </div>
                                        <!-- /media -->
                                    </li>
                                    <!-- /list item -->

                                    <!-- List Item -->
                                    <li class="dt-list__item">
                                        <!-- Media -->
                                        <div class="media">

                                            <i class="icon icon-birthday-new icon-4x mr-5 align-self-center text-yellow"></i>

                                            <!-- Media Body -->
                                            <div class="media-body">
                                                <span class="d-block text-light-gray f-12 mb-1">Birthday</span>
                                                <p class="h5 mb-0">Oct 25, 1984</p>
                                            </div>
                                            <!-- /media body -->

                                        </div>
                                        <!-- /media -->
                                    </li>
                                    <!-- /list item -->

                                    <!-- List Item -->
                                    <li class="dt-list__item">
                                        <!-- Media -->
                                        <div class="media">

                                            <i class="icon icon-graduation icon-4x mr-5 align-self-center text-yellow"></i>

                                            <!-- Media Body -->
                                            <div class="media-body">
                                                <span class="d-block text-light-gray f-12 mb-1">Went to</span>
                                                <p class="h5 mb-0">Oxford University</p>
                                            </div>
                                            <!-- /media body -->

                                        </div>
                                        <!-- /media -->
                                    </li>
                                    <!-- /list item -->

                                    <!-- List Item -->
                                    <li class="dt-list__item">
                                        <!-- Media -->
                                        <div class="media">

                                            <i class="icon icon-home icon-4x mr-5 align-self-center text-yellow"></i>

                                            <!-- Media Body -->
                                            <div class="media-body">
                                                <span class="d-block text-light-gray f-12 mb-1">Lives in London</span>
                                                <p class="h5 mb-0">From Switzerland</p>
                                            </div>
                                            <!-- /media body -->

                                        </div>
                                        <!-- /media -->
                                    </li>
                                    <!-- /list item -->

                                    <!-- List Item -->
                                    <li class="dt-list__item">
                                        <!-- Media -->
                                        <div class="media">

                                            <i class="icon icon-family icon-4x mr-5 align-self-center text-yellow"></i>

                                            <!-- Media Body -->
                                            <div class="media-body">
                                                <span class="d-block text-light-gray f-12 mb-1">4 Family Members</span>

                                                <!-- Project Team -->
                                                <ul class="dt-list dt-team-list dt-team-list-sm">
                                                    <li>
                                                        <!-- Avatar -->
                                                        <a class="dt-avatar size-25"
                                                           href="javascript:void(0)">
                                                            <img src="https://via.placeholder.com/150x150"
                                                                 alt="Steve Smith"> </a>
                                                        <!-- /avatar -->
                                                    </li>
                                                    <li>
                                                        <!-- Avatar -->
                                                        <a class="dt-avatar size-25"
                                                           href="javascript:void(0)">
                                                            <img src="https://via.placeholder.com/150x150"
                                                                 alt="Alex Dolgove"> </a>
                                                        <!-- /avatar -->
                                                    </li>
                                                    <li>
                                                        <!-- Avatar -->
                                                        <a class="dt-avatar size-25"
                                                           href="javascript:void(0)">
                                                            <img src="https://via.placeholder.com/150x150"
                                                                 alt="Reece Jacklin"> </a>
                                                        <!-- /avatar -->
                                                    </li>
                                                    <li>
                                                        <!-- Avatar -->
                                                        <a class="dt-avatar size-25"
                                                           href="javascript:void(0)">
                                                            <img src="https://via.placeholder.com/150x150"
                                                                 alt="Selena"> </a>
                                                        <!-- /avatar -->
                                                    </li>
                                                </ul>
                                                <!-- /project team -->

                                            </div>
                                            <!-- /media body -->

                                        </div>
                                        <!-- /media -->
                                    </li>
                                    <!-- /list item -->
                                </ul>
                                <!-- /list -->

                            </div>
                            <!-- /tab panel -->

                        </div>
                        <!-- /tab content-->

                    </div>
                    <!-- /card body -->

                </div>
                <!-- /card -->

            </div>
            <!-- /grid item -->

        </div>
        <!-- /grid -->

    </div>
    <!-- /profile content -->

</div>
<!-- /profile -->
@stop