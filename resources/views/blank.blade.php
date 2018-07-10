@extends('layouts.menu')

@section('content')


    <!-- BEGIN HORIZONTAL FORM -->
        <div class="row">
            <div class="col-lg-12">
                <form method="POST" action="{{ route('pool.pool.update', $pool->id) }}" accept-charset="UTF-8" id="edit_pool_form" name="edit_pool_form" class="form-horizontal">
                    <input name="_method" type="hidden" value="PUT">
                    {{ csrf_field() }}


                </form>
            </div><!--end .col -->
        </div><!--end .row -->
        <!-- END HORIZONTAL FORM -->

@endsection

@section('javascript')
    <script src="{{ asset('pool')}}" type="text/javascript"></script>
@stop