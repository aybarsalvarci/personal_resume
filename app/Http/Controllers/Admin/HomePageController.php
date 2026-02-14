<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HomePage\UpdateRequest;
use App\Models\HomePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class HomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $homepage = HomePage::firstOrFail();
        return view('admin.home.index', compact('homepage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        // find record
        $homePage = HomePage::findOrFail($id);
        Log::info("test", $homePage->toArray());
        Log::info("request test", $request->all());
        $data = $request->validated();

        // hero terminal
        $data['hero_terminal'] = array_combine($data['term_cmd'], $data['term_out']);
        unset($data['term_cmd']);
        unset($data['term_out']);

        // about cards
        $about['subtitle'] = $data['about_subtitle'];
        $about['left']['description'] = $data['about_learning'];
        $about['left']['tags'] = $data['about_learning_tags'];
        $about['right']['description'] = $data['about_technical_desc'];
        $about['right']['list'] = $data['about_skills_list'];

        $data['about'] = $about;

        unset($data['about_subtitle']);
        unset($data['about_learning']);
        unset($data['about_learning_tags']);
        unset($data['about_technical_desc']);
        unset($data['about_skills_list']);

        // stats
        $data['stats'] =array_combine($data['stat_label'], $data['stat_val']);
        unset($data['stat_label']);
        unset($data['stat_val']);

        // techstack
        $tech = [];
        for ($i = 0; $i < count($data['tech_title']); $i++) {
            $tech[] = [
                'icon' => $data['tech_icon'][$i],
                'title' => $data['tech_title'][$i],
                'description' => $data['tech_description'][$i],
                'tags' => $data['tech_tags'][$i],
            ];
        }

        $data['techs'] = $tech;

        unset($data['tech_title']);
        unset($data['tech_description']);
        unset($data['tech_tags']);
        unset($data['tech_icon']);

        // setup
        $setup['os'] = $data['setup_os'];
        $setup['editor'] = $data['setup_editor'];
        $setup['terminal'] = $data['setup_terminal'];
        $setup['db'] = $data['setup_db'];
        $setup['containerization'] = $data['setup_containerization'];

        $data['setup'] = $setup;

        unset($data['setup_os']);
        unset($data['setup_editor']);
        unset($data['setup_terminal']);
        unset($data['setup_db']);
        unset($data['setup_containerization']);

        try {
            $homePage->update($data);
            Cache::forget('home_page_settings');
        }
        catch (\Exception $e) {
            Log::error("Anasayfa güncellenirken bir hata oluştu: " . $e->getMessage(), $e->getTrace());
            return redirect()->back()->withError("Beklenmeyen bir hata oluştu.");
        }

        return redirect()->back()->withSuccess("Değişiklikler başarıyla kaydedildi.");
    }
}
