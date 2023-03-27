$(document).ready(function(){


    $(".nav-item").removeClass("active");
    $(".nav-link").removeClass("active");

    // call databletable class
    $(document).ready(function () {
        $('#sections').DataTable();
        // $('#categories').DataTable();
    });

    //Check Admin Password is correct or incorrect
    $('#current_password').keyup(function(){
        var current_password = $('#current_password').val();
        // alert(current_password);
        $.ajax({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            type:'POST',
            url: '/admin/check-admin-password',
            data: {current_password:current_password},
            success:function(resp){
                if(resp=="false"){
                    $("#check_password").html("<font color='red'>Current Password is Incorrect!</font>");
                }else if(resp=="true"){
                    $("#check_password").html("<font color='green'>Current Password is Correct</font>");
                }
            },error:function(){
                alert('Error');
            }
        });



    });


    //Update Admin Status
    $(document).on('click', ".updateAdminStatus", function(){
        var status = $(this).children("i").attr("status");
        var admin_id= $(this).attr("admin_id");

        // alert(admin_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            type: 'post',
            url: '/admin/update-admin-status',
            data: {status:status, admin_id:admin_id},
            success:function(resp){

                if (resp['status']==0){
                    $("#admin-"+resp.admin_id).html("<i style='font-size: 25px; color: #6c757d; text-align: center; display: block;' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
                     //$("a.updateAdminStatus").find("i").removeClass("mdi mdi-bookmark-check").addClass("mdi mdi-bookmark-outline");
                }else if(resp['status']==1){
                    $("#admin-"+resp.admin_id).html("<i style='font-size: 25px; color: #1982c4; text-align: center; display: block;' class='mdi mdi-bookmark-check' status='Active'></i>");
                     //$("a.updateAdminStatus").find("i").removeClass("mdi mdi-bookmark-outline").addClass("mdi mdi-bookmark-check");
                }
            },
            error:function(){
                alert("Error");
            }
        });
    });
    //Update Section Status
    $(document).on('click', ".updateSectionStatus", function(){
        var status = $(this).children("i").attr("status");
        var section_id= $(this).attr("section_id");

        // alert(admin_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            type: 'post',
            url: '/admin/update-section-status',
            data: {status:status, section_id:section_id},
            success:function(resp){
                if (resp['status']==0){
                    $("#section-"+resp.section_id).html("<i style='font-size: 25px; color: #6c757d; text-align: center; display: inline;' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
                     //$("a.updatesectionStatus").find("i").removeClass("mdi mdi-bookmark-check").addClass("mdi mdi-bookmark-outline");
                }else if(resp['status']==1){
                    $("#section-"+resp.section_id).html("<i style='font-size: 25px; color: #1982c4; text-align: center; display: inline;' class='mdi mdi-bookmark-check' status='Active'></i>");
                     //$("a.updateAdminStatus").find("i").removeClass("mdi mdi-bookmark-outline").addClass("mdi mdi-bookmark-check");
                }
            },
            error:function(){
                alert('Errors');
            }
        });
    });


    //Update Category Status
    $(document).on('click', ".updateCategoryStatus", function(){
        var status=$(this).children("i").attr("status");
        var category_id=$(this).attr('category_id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            type: 'post',
            url: '/admin/update-category-status',
            data: {status:status, category_id:category_id},

            success:function(resp){
                if(resp['status']==0){
                    $('#category-'+resp.category_id).html("<i style='font-size: 25px; color: #6c757d; text-align: center; display: inline;' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
                }
                else if(resp['status']==1){
                    $("#category-"+resp.category_id).html("<i style='font-size: 25px; color: #1982c4; text-align: center; display: inline;' class='mdi mdi-bookmark-check' status='Active'></i>");
                     //$("a.updateAdminStatus").find("i").removeClass("mdi mdi-bookmark-outline").addClass("mdi mdi-bookmark-check");
                }
            },
            error:function(){
                alert('Errors');
            }
        });
    });

    //Update Brand Status
    $(document).on('click', ".updateBrandStatus", function(){
        var status=$(this).children("i").attr("status");
        var brand_id=$(this).attr('brand_id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            type: 'post',
            url: '/admin/update-brand-status',
            data: {status:status, brand_id:brand_id},

            success:function(resp){
                if(resp['status']==0){
                    $('#brand-'+resp.brand_id).html("<i style='font-size: 25px; color: #6c757d; text-align: center; display: inline;' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
                }
                else if(resp['status']==1){
                    $("#brand-"+resp.brand_id).html("<i style='font-size: 25px; color: #1982c4; text-align: center; display: inline;' class='mdi mdi-bookmark-check' status='Active'></i>");
                     //$("a.updateAdminStatus").find("i").removeClass("mdi mdi-bookmark-outline").addClass("mdi mdi-bookmark-check");
                }
            },
            error:function(){
                alert('Errors');
            }
        });
    });


    //Updae Product Stats
    $(document).on('click', ".updateProductStatus", function(){
        var status=$(this).children("i").attr("status");
        var product_id=$(this).attr("product_id");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-product-status',
            data: {status:status, product_id:product_id},

            success:function(resp){


                if(resp['status']==0){
                    $('#product-'+resp.product_id).html("<i style='font-size: 25px; color: #6c757d; text-align: center; display: inline;' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
                }
                else if(resp['status']==1){
                    $("#product-"+resp.product_id).html("<i style='font-size: 25px; color: #1982c4; text-align: center; display: inline;' class='mdi mdi-bookmark-check' status='Active'></i>");
                     //$("a.updateAdminStatus").find("i").removeClass("mdi mdi-bookmark-outline").addClass("mdi mdi-bookmark-check");
                }
            },
            error:function(){
                alert('Errors');
            }
        })
    });

    //Confirm Box Section Delete

    // $(".confirmDelete").click(function(){
    //     var title=$(this).attr("title");
    //     if(confirm("Are you sure delete this "+title+"?")){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // });

    // Delete Section row with id
    $('.confirmDeleteSection').click(function(){
        var module_id= $(this).attr("module_id");
        var trObj = $(this);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'GET',
                            url: '/admin/delete-section/'+module_id,
                            data: {module_id:module_id},
                            success:function(resp){
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    ),
                                    trObj.parents("tr").remove();
                            },
                            error:function(){
                                alert("Error");
                            }
                        });

                }
              });

    });


    //Delete Brand row with id
    $('.confirmDeleteBrand').click(function(){
        var module_id= $(this).attr("module_id");
        var trObj = $(this);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'GET',
                            url: '/admin/delete-brand/'+module_id,
                            data: {module_id:module_id},
                            success:function(resp){
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    ),
                                    trObj.parents("tr").remove();
                            },
                            error:function(){
                                alert("Error");
                            }
                        });

                }
              });

    });


    //Delete Category with id
    $('.confirmDeleteCategory').click(function(){
        var module_id= $(this).attr("module_id");
        var trObj = $(this);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'GET',
                            url: '/admin/delete-category/'+module_id,
                            data: {module_id:module_id},
                            success:function(resp){
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    ),
                                    trObj.parents("tr").remove();
                            },
                            error:function(){
                                alert("Error");
                            }
                        });

                }
              });

    });

    //Delete Product with id
    $('.confirmDeleteProduct').click(function(){
        var module_id= $(this).attr("module_id");
        var trObj = $(this);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'GET',
                            url: '/admin/delete-product/'+module_id,
                            data: {module_id:module_id},
                            success:function(resp){
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    ),
                                    trObj.parents("tr").remove();
                            },
                            error:function(){
                                alert("Error");
                            }
                        });

                }
              });

    });


    //Delete product Image
    $('.confirmProductImageDelete').click(function(){
        var module_id = $(this).attr('moduleid');
        var module = $(this).attr("module");
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'GET',
                            url: '/admin/delete-product-image/'+module_id,
                            data: {module_id:module_id},
                            success:function(resp){
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    ),

                                    window.location.href = "/admin/add-edit-product/"+module_id;
                            },
                            error:function(){
                                location.reload();
                                alert("Error");
                            }
                        });

                }
              });
    });

    //Delete product Image
    $('.confirmProductVideoDelete').click(function(){
        var module_id = $(this).attr('moduleid');
        var module = $(this).attr("module");
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'GET',
                            url: '/admin/delete-product-video/'+module_id,
                            data: {module_id:module_id},
                            success:function(resp){
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    ),

                                    window.location.href = "/admin/add-edit-product/"+module_id;
                            },
                            error:function(){
                                location.reload();
                                alert("Error");
                            }
                        });

                }
              });
    });


    // $('.confirmDelete').click(function(){
    //     var module = $(this).attr("module");
    //     var module_id= $(this).attr("module_id");

    //     Swal.fire({
    //         title: 'Are you sure?',
    //         text: "You won't be able to revert this!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes, delete it!'
    //       }).then((result) => {
    //         if (result.isConfirmed) {
    //           Swal.fire(
    //             'Deleted!',
    //             'Your file has been deleted.',
    //             'success'
    //           )
    //           window.location = "/admin/"+module+"/"+module_id;
    //         }
    //       });
    // });


    //Append Category Level
    $("#section_id").change(function(){
        var section_id=$(this).val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: '/admin/append-categories-level/',
            data: {section_id:section_id},
            success:function(rep){
                //alert(rep);
            $(".appendCategoryLevel").html(rep);
            },
            error:function(){
                alert("Error");
            }
        })
    });


    //Product Attribute Add and Remove
    //https://www.codexworld.com/add-remove-input-fields-dynamically-using-jquery/

    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><div style="height:10px;"></div><input type="text" name="size[]" style="width: 120px;" placeholder="Size"/>&nbsp;<input type="text" name="sku[]" style="width: 120px;" placeholder="SKU"/>&nbsp;<input type="text" name="pirce[]" style="width: 120px;" placeholder="Price"/>&nbsp;<input type="text" name="stock[]" style="width: 120px;" placeholder="Stock"/>&nbsp;<a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });


});


