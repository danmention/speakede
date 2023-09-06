 <main>

     <section id="loading">
         <div id="loading-content"></div>
     </section>


     <div class="content">

            <div class="col-xl-11">

                <div class="block block-rounded h-100 mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Add Profile Picture</h3>
                    </div>
                    <div class="block-content">
                        <form role="form" method="post" action="#" enctype="multipart/form-data" style="color:#000000;" id="postFormProfilePhoto">
                            {{ csrf_field() }}
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="file" class="form-control" placeholder="Service Title Here" name="picture" required="required">
                                        <label class="form-label" for="register4-firstname">Profile Picture</label>
                                        <input type="hidden" name="home" value="home">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-plus opacity-50 me-1"></i> UPLOAD
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
 </main>
