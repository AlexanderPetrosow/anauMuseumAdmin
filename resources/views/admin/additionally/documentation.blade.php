@extends('layouts/contentNavbarLayout')

@section('title', __('words.documentation-pg'))

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
            
            
<div class="row flex-xl-nowrap">
  <div class="DocSearch-content col-12 col-xl-10 container-p-y">
    <h2 class="mb-4 doc-page-title">{{__('words.header-admin')}}
      
    </h2>
    <p>
    {{__('words.body-admin')}}
      <!-- full list of utilities.<br>
      Build whatever you want without a single line of CSS/SASS code by just using our low-level extended utility classes. -->
    </p>

    <hr class="my-5">

    <div class="row">
      <div class="col-12">
        <h4 id="link-auth" class="anchor-heading mb-4 fw-bold">{{__('words.header-authorize')}}</h4>
        <p>{{__('words.body-authorize')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-auth-login')}}</p>
        <p>{{__('words.body-auth-login')}}</p>
        <p></p>
        <p class="anchor-heading  fw-bold">{{__('words.header-password')}}</p>
        <p>{{__('words.body-password')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-lang')}}</p>
        <p>{{__('words.body-lang')}}</p>
      </div>
    </div>

    <hr class="my-5">

    <div class="row">
      <div class="col-12">
        <h4 id="link-dashboard" class="anchor-heading mb-4 fw-bold">{{__('words.header-dashboard')}}</h4>
        <p>{{__('words.body-dashboard')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-choose')}}</p>
        <p>{{__('words.body-choose')}}</p>
      </div>
    </div>
    <hr class="my-5">
    <div class="row">
      <div class="col-12">
        <h4 id="link-ticket" class="anchor-heading mb-4 fw-bold">{{__('words.header-ticket')}}</h4>
        <p>{{__('words.body-ticket')}}</p>

        <p class="anchor-heading  fw-bold">{{__('words.header-ticket-list')}}</p>
        <p>{{__('words.body-ticket-list')}}</p>
        <p></p>
      </div>
    </div>
    <hr class="my-5">
    <div class="row">
      <div class="col-12">
        <h4 id="link-add-ticket" class="anchor-heading mb-4 fw-bold">{{__('words.header-new-ticket')}}</h4>
        <p>{{__('words.body-new-ticket')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-tariff')}}</p>
        <p>{{__('words.body-tariff')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-currency')}}</p>
        <p>{{__('words.body-tariff')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-ticket-order')}}</p>
        <p>{{__('words.body-ticket-order')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-ticket-delete')}}</p>
        <p>{{__('words.body-ticket-order')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-ticket-cancel')}}</p>
        <p>{{__('words.body-ticket-delete')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-ticket-print')}}</p>
        <p>{{__('words.body-ticket-print')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-filter')}}</p>
        <p>{{__('words.body-filter')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-ticket-delete-admin')}}</p>
        <p>{{__('words.body-ticket-delete-admin')}}</p>
      </div>
    </div>
    <hr class="my-5">
    <div class="row">
      <div class="col-12">
        <h4 id="link-tariff" class="anchor-heading mb-4 fw-bold">{{__('words.header-rate')}}</h4>
        <p>{{__('words.body-rate')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-rate-list')}}</p>
        <p>{{__('words.body-rate-list')}}</p>
      </div>
    </div>
    <hr class="my-5">
    <div class="row">
      <div class="col-12">
        <h4 id="link-add-tariff" class="anchor-heading mb-4 fw-bold">{{__('words.header-rate-add')}}</h4>
        <p>{{__('words.body-rate-add')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-rate-rename')}}</p>
        <p>{{__('words.body-rate-rename')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-cost-add')}} </p>
        <p>{{__('words.body-cost-add')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-currency-choose')}}</p>
        <p>{{__('words.body-currency-choose')}} </p>
        <p class="anchor-heading  fw-bold">{{__('words.header-note')}}</p>
        <p>{{__('words.body-note')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-rate-sequence')}}</p>
        <p>{{__('words.body-rate-sequence')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-rate-status')}}</p>
        <p>{{__('words.body-rate-sequence')}} </p>
        <p class="anchor-heading  fw-bold">{{__('words.header-stock')}}</p>
        <p>{{__('words.body-stock')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-rate-delete-admin')}}</p>
        <p>{{__('words.body-rate-delete-admin')}}</p>
      </div>
    </div>
    <hr class="my-5">
    <div class="row">
      <div class="col-12">
        <h4 id="link-hall" class="anchor-heading mb-4 fw-bold">{{__('words.header-hall')}}</h4>
        <p>{{__('words.body-hall')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-hall-list')}}</p>
        <p>{{__('words.body-hall-list')}}</p>
      </div>
    </div>
    <hr class="my-5">
    <div class="row">
      <div class="col-12">
        <h4 id="link-add-hall" class="anchor-heading mb-4 fw-bold">{{__('words.header-hall-add')}}</h4>
        <p>{{__('words.body-hall-add')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-hall-rename')}}</p>
        <p>{{__('words.body-hall-rename')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-hall-status')}}</p>
        <p>{{__('words.body-hall-status')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-hall-edit')}} </p>
        <p>{{__('words.body-hall-edit')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-hall-delete')}}</p>
        <p>{{__('words.body-hall-delete')}}</p>
      </div>
    </div>
    <hr class="my-5">
    <div class="row">
      <div class="col-12">
        <h4 id="link-exposure" class="anchor-heading mb-4 fw-bold">{{__('words.header-exposition')}}</h4>
        <p>{{__('words.body-exposition')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-exposition-list')}}</p>
        <p>{{__('words.body-exposition-list')}}</p>
      </div>
    </div>
    <hr class="my-5">
    <div class="row">
      <div class="col-12">
        <h4 id="link-add-exposure" class="anchor-heading mb-4 fw-bold">{{__('words.header-exposition-add')}}</h4>
        <p>{{__('words.body-exposition-add')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-exposition-rename')}}</p>
        <p>{{__('words.body-exposition-rename')}}</p>
        <p class="anchor-heading fw-bold">{{__('words.header-exposition-desc')}}</p>
        <p> {{__('words.body-exposition-desc')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-exposition-audio')}}</p>
        <p>{{__('words.body-exposition-audio')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-hall-choose')}}</p>
        <p>{{__('words.body-hall-choose')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-image-load')}}</p>
        <p>{{__('words.body-image-load')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-exposition-sequence')}}</p>
        <p>{{__('words.body-exposition-sequence')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-exposition-status')}}</p>
        <p>{{__('words.body-exposition-status')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-exposition-edit')}}</p>
        <p>{{__('words.body-exposition-edit')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-exposition-delete')}}</p>
        <p>{{__('words.body-exposition-delete')}}</p>
      </div>
    </div>
    <hr class="my-5">
    <div class="row">
      <div class="col-12">
        <h4 id="link-exhibit" class="anchor-heading mb-4 fw-bold">{{__('words.header-exhibit')}}</h4>
        <p>{{__('words.body-exhibit')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-exhibit-list')}}</p>
        <p>{{__('words.body-exhibit')}}</p>
      </div>
    </div>
    <hr class="my-5">
    <div class="row">
      <div class="col-12">
        <h4 id="link-add-exhibit" class="anchor-heading mb-4 fw-bold">{{__('words.header-exhibit-add')}}</h4>
        <p>{{__('words.body-exhibit-add')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-exhibit-rename')}}</p>
        <p>{{__('words.body-exhibit-rename')}}</p>
        <p class="anchor-heading fw-bold">{{__('words.header-exhibit-desc')}}</p>
        <p>{{__('words.body-exhibit-desc')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-exhibit-audio')}}</p>
        <p>{{__('words.body-exhibit-audio')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-exhibit-hall')}}</p>
        <p>{{__('words.body-exhibit-hall')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-exhibit-choose')}}</p>
        <p>{{__('words.body-exhibit-choose')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-exhibit-image')}}</p>
        <p>{{__('words.body-exhibit-image')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-exhibit-sequence')}}</p>
        <p>{{__('words.body-exhibit-sequence')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-exhibit-status')}}</p>
        <p>{{__('words.body-exhibit-status')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-exhibit-edit')}}</p>
        <p>{{__('words.body-exhibit-edit')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-exhibit-delete')}}</p>
        <p>{{__('words.body-exhibit-delete')}}</p>
      </div>
    </div>
    <hr class="my-5">
    <div class="row">
      <div class="col-12">
        <h4 id="link-user" class="anchor-heading mb-4 fw-bold">{{__('words.header-users')}}</h4>
        <p>{{__('words.body-users')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-users-list')}}</p>
        <p>{{__('words.body-users-list')}}</p>
      </div>
    </div>
    <hr class="my-5">
    <div class="row">
      <div class="col-12">
        <h4 id="link-add-user" class="anchor-heading mb-4 fw-bold">{{__('words.header-user-add')}}</h4>
        <p>{{__('words.body-user-add')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-login')}}</p>
        <p>{{__('words.body-login')}}</p>
        <p class="anchor-heading fw-bold">{{__('words.header-fio')}}</p>
        <p>{{__('words.body-fio')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-access')}}</p>
        <p>{{__('words.body-access')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-user-status')}}</p>
        <p>{{__('words.body-user-status')}} </p>
        <p class="anchor-heading  fw-bold">{{__('words.header-user-edit')}}</p>
        <p>{{__('words.body-user-edit')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-user-delete')}}</p>
        <p>{{__('words.body-user-delete')}}</p>
      </div>
    </div>
    <hr class="my-5">
    <div class="row">
      <div class="col-12">
        <h4 id="link-doc" class="anchor-heading mb-4 fw-bold">{{__('words.header-document')}}</h4>
        <p>{{__('words.body-document')}}</p>
        <p class="anchor-heading  fw-bold">{{__('words.header-document-admin')}}</p>
        <p>{{__('words.body-document-admin')}}</p>
      </div>
    </div>
    <hr class="my-5">
    <div class="row">
      <div class="col-12">
        <h4 id="link-support" class="anchor-heading mb-4 fw-bold">{{__('words.header-support')}}</h4>
        <p>{{__('words.body-support')}}</p>
      </div>
    </div>
  </div>
  <div class="d-none d-xl-block col-xl-2 doc-sidebar container-p-y">
    <nav id="vertical-nav" class="navbar p-0">
      <ul class="doc-sidebar-nav">
        <li class="doc-entry doc-h2"><a class="nav-link" href="#link-auth">{{__('words.header-authorize')}}</a></li>
        </li>
        <li class="doc-entry doc-h2"><a class="nav-link" href="#link-dashboard">{{__('words.dashboard')}}
        </li>
        <li class="doc-entry doc-h2"><a class="nav-link" href="#link-tariff">{{__('words.tariffs')}}</a>
        </li>
        <li class="doc-entry doc-h2"><a class="nav-link" href="#link-add-tariff">{{__('words.header-authorize')}}</a>
        </li>
        <li class="doc-entry doc-h2"><a class="nav-link" href="#link-hall">{{__('words.halls')}}</a>
        </li>
        <li class="doc-entry doc-h2"><a class="nav-link" href="#link-add-hall">{{__('words.header-hall-add')}}</a>
        </li>
        <li class="doc-entry doc-h2"><a class="nav-link" href="#link-exposure">{{__('words.header-exposition')}}</a>
        </li>
        <li class="doc-entry doc-h2"><a class="nav-link" href="#link-add-exposure">{{__('words.add-exposure')}}</a>
        </li>
        <li class="doc-entry doc-h2"><a class="nav-link" href="#link-exhibit">{{__('words.exhibits')}}</a>
        </li>
        <li class="doc-entry doc-h2"><a class="nav-link" href="#link-add-exhibit">{{__('words.add-exhibit')}}</a>
        </li>
        <li class="doc-entry doc-h2"><a class="nav-link" href="#link-user">{{__('words.users')}}</a>
        </li>
        <li class="doc-entry doc-h2"><a class="nav-link" href="#link-add-user">{{__('words.add-user')}}</a>
        </li>
        <li class="doc-entry doc-h2"><a class="nav-link" href="#link-doc">{{__('words.documentation')}}</a>
        </li>
        <li class="doc-entry doc-h2"><a class="nav-link" href="#link-support">{{__('words.support')}}</a>
        </li>
      </ul>
    </nav>
  </div>
</div>

          </div>
          @endsection