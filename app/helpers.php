<?php
function bytesToHuman($bytes)
{
    $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

    for ($i = 0; $bytes > 1024; $i++) {
        $bytes /= 1024;
    }

    return round($bytes, 2) . ' ' . $units[$i];
}

function messageFilePath($file, $thumb = false)
{
    return asset('storage/' . config('messenger.file_path') . '/' . $file->conversation_id . '/' . ($thumb ? '/thumb-' : '') . $file->name);
}

function noteSeeCount($id)
{
    $count = \Illuminate\Support\Facades\DB::table('conversations')
        ->leftJoin('messages', 'conversations.id', '=', 'messages.conversation_id')
        ->select(\Illuminate\Support\Facades\DB::raw("count(*) as count"))
        ->where(function ($query) use ($id) {
            $query->where('user_two', $id)
                ->orWhere('user_one', $id);
        })
        ->where('messages.sender_id', '!=', $id)
        ->where('messages.is_seen', 0)
        ->first();
    return $count->count;
}


function getCountries($id = null)
{
    if ($id) {
        return \App\Models\Country::find($id);
    }
    return \App\Models\Country::get();
}

function getCities($id = null)
{
    if ($id) {
        return \App\Models\City::find($id);
    }
    return \App\Models\City::get();
}

function getState($id = null)
{
    if ($id) {
        return \App\Models\State::find($id);
    }
    return \App\Models\State::get();
}

function getCategories($id = null)
{
    if ($id) {
        return \App\Models\FreelanceTitle::find($id);
    }
    return \App\Models\FreelanceTitle::get();
}

function getSkills($id = null)
{
    if ($id) {
        return \App\Models\Skill::find($id);
    }
    return \App\Models\Skill::get();
}

function myGetUserIP()
{
    $client = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote = @$_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }

    return $ip ?: '0.0.0.0';
}

function getMyJobs($id = null)
{
    if ($id) {
        return \App\Models\Job::find($id);
    }
    return auth()->user()->jobs;
}


// Converts a number into a short version, eg: 1000 -> 1k
function number_format_short($n, $precision = 1)
{
    $n = (int)$n;
    if ($n < 900) {
        // 0 - 900
        $n_format = number_format($n, $precision);
        $suffix = '';
    } else if ($n < 900000) {
        // 0.9k-850k
        $n_format = number_format($n / 1000, $precision);
        $suffix = 'K';
    } else if ($n < 900000000) {
        // 0.9m-850m
        $n_format = number_format($n / 1000000, $precision);
        $suffix = 'M';
    } else if ($n < 900000000000) {
        // 0.9b-850b
        $n_format = number_format($n / 1000000000, $precision);
        $suffix = 'B';
    } else {
        // 0.9t+
        $n_format = number_format($n / 1000000000000, $precision);
        $suffix = 'T';
    }
    // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
    // Intentionally does not affect partials, eg "1.50" -> "1.50"
    if ($precision > 0) {
        $dotzero = '.' . str_repeat('0', $precision);
        $n_format = str_replace($dotzero, '', $n_format);
    }
    return '$ ' . $n_format . $suffix;
}