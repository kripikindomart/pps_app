<template>
    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Responsive Hover Table</h3>

            <div class="card-tools">
                
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-add">
                <i class="fas fa-user-plus fa-fw"></i> Tambah Role
                </button>
            </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Role</th>
                    <th>Action</th>
                    
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in roles" :key="item.message">
                  <td>{{item.role}}</td>
                  <td>
                       <a href="" class="btn btn-warning"> <i class="fas fa-edit"></i> Edit</a>
                        <a href="" class="btn btn-danger"> <i class="fas fa-trash"></i> Delete </a>
                  </td>
                </tr>
                
                </tbody>
            </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
        <!-- Modal -->
        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>
    </div>





</template>
<script>

export default {
   data(){
       return {
           roles : {}
    }
   },
   methods : {
       loadData(){
           axios.get('api/role').then(({data}) => (this.roles = data))
       }
   },
   created(){
       this.loadData();
       console.log(this.loadData())
   }
   
}
</script>