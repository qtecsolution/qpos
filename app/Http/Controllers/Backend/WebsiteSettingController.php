<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Rules\ValidImageType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ImageHandlerController;

class WebsiteSettingController extends Controller
{
    public function websiteGeneral(Request $request)
    {
        return view('backend.settings.website-settings.general');
    }

    public function websiteInfoUpdate(Request $request)
    {
        $request->validate([
            'site_name' => 'required',
            'site_url' => 'url'
        ]);

        foreach ($request->except('_token') as $key => $value) {
            writeConfig($key, $value);
        }
        Artisan::call('config:clear');
        return to_route('backend.admin.settings.website.general', ['active-tab' => 'website-info'])
            ->with('success', 'Updated successfully');
    }

    public function websiteContactsUpdate(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            writeConfig($key, $value);
        }
        Artisan::call('config:clear');
        return to_route('backend.admin.settings.website.general', ['active-tab' => 'contacts'])
            ->with('success', 'Updated successfully');
    }

    public function websiteSocialLinkUpdate(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            writeConfig($key, $value);
        }
        Artisan::call('config:clear');
        return to_route('backend.admin.settings.website.general', ['active-tab' => 'social-links'])
            ->with('success', 'Updated successfully');
    }

    public function websiteStyleSettingsUpdate(Request $request)
    {
        $request->validate([
            'site_logo' => ['file', new ValidImageType],
            'favicon_icon' => ['file', new ValidImageType],
            'favicon_icon_apple' => ['file', new ValidImageType],
        ]);

        writeConfig('newsletter_subscribe', $request->newsletter_subscribe);

        if ($request->hasFile("site_logo")) {
            $imageController = new ImageHandlerController();

            $imageController->securePublicUnlink(readConfig('site_logo'));
            $site_logo = $imageController->uploadToPublic($request->file("site_logo"), "/assets/images/logo");
            writeConfig('site_logo', $site_logo);
        }
        if ($request->hasFile("favicon_icon")) {
            $imageController = new ImageHandlerController();

            $imageController->securePublicUnlink(readConfig('favicon_icon'));
            $favicon_icon = $imageController->uploadToPublic($request->file("favicon_icon"), "/assets/images/logo");
            writeConfig('favicon_icon', $favicon_icon);
        }
        if ($request->hasFile("favicon_icon_apple")) {
            $imageController = new ImageHandlerController();

            $imageController->securePublicUnlink(readConfig('favicon_icon_apple'));
            $favicon_icon_apple = $imageController->uploadToPublic($request->file("favicon_icon_apple"), "/assets/images/logo");
            writeConfig('favicon_icon_apple', $favicon_icon_apple);
        }
        Artisan::call('config:clear');
        return to_route('backend.admin.settings.website.general', ['active-tab' => 'style-settings'])
            ->with('success', 'Updated successfully');
    }

    public function websiteCustomCssUpdate(Request $request)
    {
        writeConfig('custom_css', $request->custom_css);
        Artisan::call('config:clear');
        return to_route('backend.admin.settings.website.general', ['active-tab' => 'custom-css'])
            ->with('success', 'Updated successfully');
    }

    public function websiteNotificationSettingsUpdate(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            writeConfig($key, $value);
        }
        Artisan::call('config:clear');
        return to_route('backend.admin.settings.website.general', ['active-tab' => 'notification-settings'])
            ->with('success', 'Updated successfully');
    }

    public function websiteStatusUpdate(Request $request)
    {
        writeConfig('is_live', $request->is_live);
        Artisan::call('config:clear');
        return to_route('backend.admin.settings.website.general', ['active-tab' => 'website-status'])
            ->with('success', 'Updated successfully');
    }
}
