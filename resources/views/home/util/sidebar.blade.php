<div class="col-lg-3">
    <!-- Sidebar Wrapper Start -->
    <div class="sidebar-wrap-02">

        <!-- Sidebar Wrapper Start -->
        <div class="sidebar-widget-02">
            <h3 class="widget-title">Type of Courses</h3>

            <div class="widget-checkbox">
                <ul class="checkbox-list">
                    <li class="form-check">
                        <input class="form-check-input" type="checkbox" value="free" name="type" id="checkbox1">
                        <label class="form-check-label" for="checkbox1">Free ({{$free_course}})</label>
                    </li>
                    <li class="form-check">
                        <input class="form-check-input" type="checkbox" value="paid" name="type" id="checkbox2">
                        <label class="form-check-label" for="checkbox2">Paid ({{$paid_course}})</label>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Sidebar Wrapper End -->

        <!-- Sidebar Wrapper Start -->
        <div class="sidebar-widget-02">
            <h3 class="widget-title">Tutors</h3>

            <div class="widget-checkbox">
                <ul class="checkbox-list">

                    @foreach($instructors as $row)
                        <li class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="checkbox6">
                            <label class="form-check-label" for="checkbox6">{{$row->firstname.' '.$row->lastname}} ({{$row->number_of_course}})</label>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- Sidebar Wrapper End -->

        <!-- Sidebar Wrapper Start -->
        <div class="sidebar-widget-02">
            <h3 class="widget-title">Theme</h3>

            <div class="widget-checkbox">
                <ul class="checkbox-list">
                    <li class="form-check">
                        <input class="form-check-input" type="checkbox" value="free" name="type" id="checkbox1">
                        <label class="form-check-label" for="checkbox1">Free ({{$free_course}})</label>
                    </li>
                    <li class="form-check">
                        <input class="form-check-input" type="checkbox" value="paid" name="type" id="checkbox2">
                        <label class="form-check-label" for="checkbox2">Paid ({{$paid_course}})</label>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Sidebar Wrapper End -->


    </div>
    <!-- Sidebar Wrapper End -->
</div>
