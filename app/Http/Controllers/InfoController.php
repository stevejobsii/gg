<?php namespace App\Http\Controllers;
use App\Article;
use App\Vote;

class InfoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
  
    public function index()
    {
        $author_id = '1';
        $this->authorOrAdminPermissioinRequire($author_id);
        return view('tags.create');
    }