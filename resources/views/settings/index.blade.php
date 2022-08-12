<x-layout.app heading="Settings">
    @section('content-header')
        <x-layout.content-header 
            heading="{{ __('Ustawienia Systemowe') }}!"
            module_text="module"

            action_text="index"
            action_link="indexLink"
        ></x-layout.content-header>
    @endsection

    <x-settings.section title="Section #1">
        <div class="mb-3">
            <label for="setting-input-1" class="form-label">Business Name</label>
            <input type="text" class="form-control" id="setting-input-1" value="Lorem Ipsum Ltd." required="">
        </div>
        <div class="mb-3">
            <label for="setting-input-2" class="form-label">Contact Name</label>
            <input type="text" class="form-control" id="setting-input-2" value="Steve Doe" required="">
        </div>
        <div class="mb-3">
            <label for="setting-input-3" class="form-label">Business Email Address</label>
            <input type="email" class="form-control" id="setting-input-3" value="hello@companywebsite.com">
        </div>
    </x-settings.section>

    <x-settings.section title="Section #2">
        <x-slot name="description">
            !!! Settings section intro goes here. Lorem ipsum dolor sit amet, consectetur adipiscing
            elit. <a href="help.html">Learn more</a>
        </x-slot>

            <div class="mb-2"><strong>Current Plan:</strong> Pro</div>
            <div class="mb-2"><strong>Status:</strong> <span class="badge bg-success">Active</span></div>
            <div class="mb-2"><strong>Expires:</strong> 2030-09-24</div>
            <div class="mb-4"><strong>Invoices:</strong> <a href="#">view</a></div>
            <div class="row justify-content-between">
                <div class="col-auto">
                    <a class="btn app-btn-primary" href="#">Upgrade Plan</a>
                </div>
                <div class="col-auto">
                    <a class="btn app-btn-secondary" href="#">Cancel Plan</a>
                </div>
            </div>
    </x-settings.section>

    <x-settings.section title="Section #3">

            <form class="settings-form">
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="" id="settings-checkbox-1" checked="">
                    <label class="form-check-label" for="settings-checkbox-1">
                        Keep user app activity history
                    </label>
                </div>
                <!--//form-check-->
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="" id="settings-checkbox-2" checked="">
                    <label class="form-check-label" for="settings-checkbox-2">
                        Keep user app preferences
                    </label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="" id="settings-checkbox-3">
                    <label class="form-check-label" for="settings-checkbox-3">
                        Keep user app search history
                    </label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="" id="settings-checkbox-4">
                    <label class="form-check-label" for="settings-checkbox-4">
                        Lorem ipsum dolor sit amet
                    </label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="" id="settings-checkbox-5">
                    <label class="form-check-label" for="settings-checkbox-5">
                        Aenean quis pharetra metus
                    </label>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn app-btn-primary">Save Changes</button>
                </div>
            </form>
    </x-settings.section>

    <x-settings.section title="Section #4">
        <form class="settings-form">
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="settings-switch-1" checked="">
                <label class="form-check-label" for="settings-switch-1">Project notifications</label>
            </div>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="settings-switch-2">
                <label class="form-check-label" for="settings-switch-2">Web browser push notifications</label>
            </div>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="settings-switch-3" checked="">
                <label class="form-check-label" for="settings-switch-3">Mobile push notifications</label>
            </div>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="settings-switch-4">
                <label class="form-check-label" for="settings-switch-4">Lorem ipsum notifications</label>
            </div>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="settings-switch-5">
                <label class="form-check-label" for="settings-switch-5">Lorem ipsum notifications</label>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn app-btn-primary">Save Changes</button>
            </div>
        </form>
    </x-settings.section>

</x-layout.app>