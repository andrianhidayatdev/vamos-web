@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')


<div class="pc-container">
  <div class="pc-content">
    <div class="row">
      <div class="col-xl-12 col-md-12">
        <div class="card ">

          <div class="card-body">
            <div class="mb-3 align-items-center">
              <h1 class="">{{ $name }}</h1>

            </div>
            <div class="table-responsive">
              <table id="example" class="table table-striped overflow-scroll" style="width:100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>{{ __('messages.date_time') }}</th>
                    <th>{{ __('messages.user') }}</th>
                    <th>{{ __('messages.action') }}</th>
                    <th>{{ __('messages.table') }}</th>
                    <th>{{ __('messages.message') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($log as $row)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->updated_at }}</td>
                    <td>{{ $row->user->name}}</td>
                    <td>{{ ucwords($row->action) }}</td>
                    <td>{{ str_replace('_', ' ', ucwords($row->table_name, '_')) }}</td>
                    <td>{{ $row->message }}</td>

                  </tr>
                  @endforeach
                </tbody>

              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('layouts.footer')
