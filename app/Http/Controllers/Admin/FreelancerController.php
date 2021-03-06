<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Voyager\VoyagerBaseController;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FreelancerController extends VoyagerBaseController
{

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email'
        ]);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->messages()]);
        }

        if (!$request->ajax()) {
            $user = new User();
            $user->name = $request->full_name;
            $user->email = $request->email;
            $user->email_verified_at = Carbon::now()->toDateTimeString();
            $user->role_id = 3;
            $user->password = bcrypt(config('app.user_default_password'));
            $slug = str_slug($request->full_name);

            if (User::where('slug', $slug)->first()) {
                while (true) {
                    $slug = $slug . '-' . str_random(3);
                    if (!User::where('slug', $slug)->first()) {
                        break;
                    }
                }
            }

            $user->slug = $slug;

            $user->save();
            $request['user_id'] = $user->id;
        }

        return parent::store($request); // TODO: Change the autogenerated stub
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,' . $request->user_id
        ]);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->messages()]);
        }
        if (!$request->ajax()) {
            $user = User::find($request->user_id);
            $user->name = $request->full_name;
            $user->email = $request->email;
            $user->save();
        }
        return parent::update($request, $id); // TODO: Change the autogenerated stub

    }

    public function insertUpdateData($request, $slug, $rows, $data)
    {
//        dd($request->all());
        $multi_select = [];

        /*
         * Prepare Translations and Transform data
         */
        $translations = is_bread_translatable($data)
            ? $data->prepareTranslations($request)
            : [];

        foreach ($rows as $row) {
            // if the field for this row is absent from the request, continue
            // checkboxes will be absent when unchecked, thus they are the exception
            if (!$request->hasFile($row->field) && !$request->has($row->field) && $row->type !== 'checkbox') {
                // if the field is a belongsToMany relationship, don't remove it
                // if no content is provided, that means the relationships need to be removed
                if ((isset($row->details->type) && $row->details->type !== 'belongsToMany') || $row->field !== 'user_belongsto_role_relationship') {
                    continue;
                }
            }

            $content = $this->getContentBasedOnType($request, $slug, $row, $row->details);

            if ($row->type == 'relationship' && $row->details->type != 'belongsToMany') {
                $row->field = @$row->details->column;
            }

            /*
             * merge ex_images and upload images
             */
            if ($row->type == 'multiple_images' && !is_null($content)) {
                if (isset($data->{$row->field})) {
                    $ex_files = json_decode($data->{$row->field}, true);
                    if (!is_null($ex_files)) {
                        $content = json_encode(array_merge($ex_files, json_decode($content)));
                    }
                }
            }

            if (is_null($content)) {

                // If the image upload is null and it has a current image keep the current image
                if ($row->type == 'image' && is_null($request->input($row->field)) && isset($data->{$row->field})) {
                    $content = $data->{$row->field};
                }

                // If the multiple_images upload is null and it has a current image keep the current image
                if ($row->type == 'multiple_images' && is_null($request->input($row->field)) && isset($data->{$row->field})) {
                    $content = $data->{$row->field};
                }

                // If the file upload is null and it has a current file keep the current file
                if ($row->type == 'file') {
                    $content = $data->{$row->field};
                }

                if ($row->type == 'password') {
                    $content = $data->{$row->field};
                }
            }

            if ($row->type == 'relationship' && $row->details->type == 'belongsToMany') {
                // Only if select_multiple is working with a relationship
                $multi_select[] = ['model' => $row->details->model, 'content' => $content, 'table' => $row->details->pivot_table];
            } else {
                $data->{$row->field} = $content;
            }
        }

        $data->save();

        // Save translations
        if (count($translations) > 0) {
            $data->saveTranslations($translations);
        }

        foreach ($multi_select as $sync_data) {
            $data->belongsToMany($sync_data['model'], $sync_data['table'])->sync($sync_data['content']);
        }

        $data->workHistories()->delete();
        $histories = json_decode($data->work_history, true);

        foreach ($histories as $history) {
            $data->workHistories()->create($history);
        }
        foreach ($data->skills as $skill) {
            if (!$skill->pivot->percent){

                $skill->pivot->percent = rand(75, 100);
                $skill->pivot->save();
            }
        }
        return $data;
    }
}
