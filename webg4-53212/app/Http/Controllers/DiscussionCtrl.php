<?php
namespace App\Http\Controllers;
use App\Models\Discussion;

class DiscussionCtrl extends Controller {
    public function index() {

        $discussions = Discussion::getAllDiscussionsTitle();
        return view( 'index', [ 'discussions' => $discussions ] );
    }
}
