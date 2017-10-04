@include('layouts.header')
@include('layouts.nav')
<div class="row registerform">
<div class="col-md-12">
   <div class="panel panel-card recent-activites">
      <!-- Start .panel -->
      <div class="card-header">
         Order Status
      </div>
      <div class="card-block text-xs-center">
         <div class="table-responsive table-commerce">
            <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
               <div class="row">
                  <div class="col-md-6 col-xs-12 ">
                     <div class="dataTables_length" id="basic-datatables_length"><label></label></div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                     <div id="basic-datatables_filter" class="dataTables_filter"></div>
                  </div>
               </div>
               <table id="basic-datatables" class="table table-striped table-hover dataTable no-footer" role="grid" aria-describedby="basic-datatables_info">
                  <thead>
                     <tr role="row">
                        <th class="w80 sorting_asc" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" aria-sort="ascending" 
                           style="width: 56px;">
                           <strong>ID</strong>
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" aria-label="
                           " style="width: 146px;">
                           <strong>Name</strong>
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" aria-label="
                           " style="width: 173px;">
                           <strong>Email</strong>
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" aria-label="
                           " style="width: 91px;">
                           <strong>Sex</strong>
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" aria-label="
                           " style="width: 96px;">
                           <strong>Phone Number</strong>
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" aria-label="
                           " style="width: 116px;">
                           <strong>Role</strong>
                        </th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($users as $user)
                     <tr role="row" class="odd">
                        <td class="sorting_1">{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->sex}}</td>
                        <td>{{$user->phone_number}}</td>
                        @if($user->role == 'admin')
                        <td> <span class="tag label-success">{{$user->role}}</span></td>
                        @else
                        <td> <span class="tag label-info">{{$user->role}}</span></td>
                        @endif
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <!-- End .panel --> 
   </div>
</div>
    @include('layouts.footer')