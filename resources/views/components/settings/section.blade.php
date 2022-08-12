
<div class="row settings-section">
    <div class="col-12 col-md-3">
        <h3 class="section-title">{{ $title ?? '' }}</h3>
        <div class="section-description">{{ $description ?? '' }}</div>
    </div>
    <div class="col-12 col-md-9">
        <div class="card card-primary card-outline app-card app-card-settings">
            <div class="card-body app-card-body">
                <form class="settings-form">
                    {{ $slot }}
                </form>
            </div>
            <!--//app-card-body-->
            <div class="card-footer app-card-footer">
                <button type="submit" class="btn btn-primary app-btn-primary">Save Changes</button>
            </div>
        </div>
        <!--//app-card-->
    </div>
</div>