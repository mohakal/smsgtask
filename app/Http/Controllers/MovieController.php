<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieCast;
use App\Models\MovieTag;
use Faker\Core\DateTime;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $subscriptionTypes = DB::table('subscription_types')->get();
        $response = Http::get('http://www.omdbapi.com', [
            'apikey' => '407e5227',
            'i' => $request->i,
        ]);
        return view('resultsFromOMDB', ['result' => json_decode($response,true),'subscriptionTypes' =>$subscriptionTypes]);
       // return response($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function savemovie(Request $request)
    {
        $movieid = DB::table('movies')->insertGetId([
            'title' => $request->title,
            'release_year' => $request->release,
            'poster_link' => $request->posterlink,
            'subsciption_type_id' => $request->subscriptiontype,
            'rent_period' => $request->rent_period,
            'rent_price' => $request->rent_price,
            'license_start' => $request->license_start,
            'license_end' => $request->license_end,
            'created_at'=> now(),
            'updated_at'=> now()
        ]);
        // insert cast
        $casts = explode(",",$request->casts);
        $castInsert = [];
        $castSearch = [];
        $i=0;
        foreach($casts AS $cast){
            $castInsert[$i]['name'] = trim($cast);
            $castInsert[$i]['created_at'] = now();
            $castInsert[$i]['updated_at'] = now();
            $castSearch[]=trim($cast);
            $i++;
        }
        DB::table('casts')->insertOrIgnore($castInsert);
        $castIds = DB::table('casts')
            ->select('id')
            ->whereIn('name', $castSearch)
            ->get();
        $movieCastInsert = [];
        $i=0;
        foreach ($castIds AS $cast){
            $movieCastInsert[$i]['movie_id'] = $movieid;
            $movieCastInsert[$i]['cast_id'] = $cast->id;
            $movieCastInsert[$i]['created_at'] = now();
            $movieCastInsert[$i]['updated_at'] = now();
            $i++;
        }
        DB::table('movie_casts')->insert($movieCastInsert);
        //die('asd');

        // insert genre/tag
        $genres = explode(",",$request->genre);
        $genreInsert = [];
        $genreSearch = [];
        $i=0;
        foreach($genres AS $genre){
            $genreInsert[$i]['name'] = trim($genre);
            $genreInsert[$i]['created_at'] = now();
            $genreInsert[$i]['updated_at'] = now();
            $genreSearch[]=trim($genre);
            $i++;
        }
        DB::table('tags')->insertOrIgnore($genreInsert);
        $genreIds = DB::table('tags')
            ->select('id')
            ->whereIn('name', $genreSearch)
            ->get();
        $moviegenreInsert = [];
        $i=0;
        foreach ($genreIds AS $genre){
            $moviegenreInsert[$i]['movie_id'] = $movieid;
            $moviegenreInsert[$i]['tag_id'] = $genre->id;
            $moviegenreInsert[$i]['created_at'] = now();
            $moviegenreInsert[$i]['updated_at'] = now();
            $i++;
        }
        DB::table('movie_tags')->insert($moviegenreInsert);
        return redirect()->route('allmovies')->with('success', 'Movie Added!');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // check for tags
        if($request->casts!==trim($request->old_casts)){
            //remove all cast from movie_casts
            MovieCast:: where('movie_id',$id)->delete();
            // insert cast
            $casts = explode(",",$request->casts);
            $castInsert = [];
            $castSearch = [];
            $i=0;
            foreach($casts AS $cast){
                $castInsert[$i]['name'] = trim($cast);
                $castInsert[$i]['created_at'] = now();
                $castInsert[$i]['updated_at'] = now();
                $castSearch[]=trim($cast);
                $i++;
            }
            DB::table('casts')->insertOrIgnore($castInsert);
            $castIds = DB::table('casts')
                ->select('id')
                ->whereIn('name', $castSearch)
                ->get();
            $movieCastInsert = [];
            $i=0;
            foreach ($castIds AS $cast){
                $movieCastInsert[$i]['movie_id'] = $id;
                $movieCastInsert[$i]['cast_id'] = $cast->id;
                $movieCastInsert[$i]['created_at'] = now();
                $movieCastInsert[$i]['updated_at'] = now();
                $i++;
            }
            DB::table('movie_casts')->insert($movieCastInsert);

        }
        //check  for casts
        if($request->genre!==trim($request->old_genre)){
            //remove all cast from movie_casts
            MovieTag:: where('movie_id',$id)->delete();
            $genres = explode(",",$request->genre);
            $genreInsert = [];
            $genreSearch = [];
            $i=0;
            foreach($genres AS $genre){
                $genreInsert[$i]['name'] = trim($genre);
                $genreInsert[$i]['created_at'] = now();
                $genreInsert[$i]['updated_at'] = now();
                $genreSearch[]=trim($genre);
                $i++;
            }
            DB::table('tags')->insertOrIgnore($genreInsert);
            $genreIds = DB::table('tags')
                ->select('id')
                ->whereIn('name', $genreSearch)
                ->get();
            $moviegenreInsert = [];
            $i=0;
            foreach ($genreIds AS $genre){
                $moviegenreInsert[$i]['movie_id'] = $id;
                $moviegenreInsert[$i]['tag_id'] = $genre->id;
                $moviegenreInsert[$i]['created_at'] = now();
                $moviegenreInsert[$i]['updated_at'] = now();
                $i++;
            }
            DB::table('movie_tags')->insert($moviegenreInsert);
        }
        // update movie
        Movie::where("id",$id)->update([
            'title'=>$request->title,
            'release_year'=>$request->release,
            'poster_link'=>$request->posterlink,
            'subsciption_type_id'=>$request->subscriptiontype,
            'rent_period'=>$request->rent_period,
            'rent_price'=>$request->rent_price,
            'license_start'=>$request->license_start,
            'license_end'=>$request->license_end,
            'updated_at'=>now()
        ]);

        return redirect()->route('editmovie',['id'=>$id])->with('success', 'Movie Updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        $movie->delete();
        MovieTag:: where('movie_id',$id)->delete();
        MovieCast:: where('movie_id',$id)->delete();
        return redirect()->route('allmovies')->with('success', 'Movie Deleted!');
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function allmovies()
    {
        $movies = DB::select( DB::raw("SELECT a.*,GROUP_CONCAT(DISTINCT(c.name)) AS 'casts',GROUP_CONCAT(DISTINCT(e.name)) AS 'tags',f.name AS 'subs' FROM movies AS a
LEFT JOIN `movie_casts` AS b ON a.id=b.movie_id
LEFT JOIN `casts` AS c ON b.cast_id=c.id
LEFT JOIN `movie_tags` AS d ON a.id=d.movie_id
LEFT JOIN `tags` AS e ON d.tag_id=e.id
LEFT JOIN `subscription_types` AS f ON a.subsciption_type_id=f.id
GROUP BY a.id") );
       // var_dump(json_encode($movies));
        return view('viewallmovies', ['result' => $movies,'usertype'=>'admin']);
        //die('here');
    }
    /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function editmovie($id)
    {
        $subscriptionTypes = DB::table('subscription_types')->get();
        $movies = DB::select( DB::raw("SELECT a.*,GROUP_CONCAT(DISTINCT(c.name)) AS 'casts',GROUP_CONCAT(DISTINCT(e.name)) AS 'tags',f.name AS 'subs' FROM movies AS a
LEFT JOIN `movie_casts` AS b ON a.id=b.movie_id
LEFT JOIN `casts` AS c ON b.cast_id=c.id
LEFT JOIN `movie_tags` AS d ON a.id=d.movie_id
LEFT JOIN `tags` AS e ON d.tag_id=e.id
LEFT JOIN `subscription_types` AS f ON a.subsciption_type_id=f.id
WHERE a.id= :id
GROUP BY a.id "), ['id' => $id] );
        // var_dump($movies);
       return view('editmovie', ['result' => $movies[0],'subscriptionTypes' =>$subscriptionTypes]);
    //    die('here');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchmovie(Request $request)
    {
        $search_term = $request->searchterm;

        $movies = DB::select( DB::raw("SELECT a.*,GROUP_CONCAT(DISTINCT(c.name)) AS 'casts',GROUP_CONCAT(DISTINCT(e.name)) AS 'tags',f.name AS 'subs' FROM movies AS a
LEFT JOIN `movie_casts` AS b ON a.id=b.movie_id
LEFT JOIN `casts` AS c ON b.cast_id=c.id
LEFT JOIN `movie_tags` AS d ON a.id=d.movie_id
LEFT JOIN `tags` AS e ON d.tag_id=e.id
LEFT JOIN `subscription_types` AS f ON a.subsciption_type_id=f.id
WHERE (a.title LIKE :searchterm1 OR a.id IN (
SELECT movie_id FROM `movie_tags` WHERE tag_id IN (SELECT id FROM `tags` WHERE NAME LIKE :searchterm2  )
)
)
GROUP BY a.id "), ['searchterm1' => '%'.$search_term.'%','searchterm2' => '%'.$search_term.'%'] );
        // var_dump($movies);
        return view('viewallmovies', ['result' => $movies,'usertype'=>'admin']);
    }
    /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function subcribermovies()
    {
        $result = [];
        $user = Auth::user();
        $movies = DB::select( DB::raw("SELECT a.*,GROUP_CONCAT(DISTINCT(c.name)) AS 'casts',GROUP_CONCAT(DISTINCT(e.name)) AS 'tags',f.name AS 'subs' FROM movies AS a
LEFT JOIN `movie_casts` AS b ON a.id=b.movie_id
LEFT JOIN `casts` AS c ON b.cast_id=c.id
LEFT JOIN `movie_tags` AS d ON a.id=d.movie_id
LEFT JOIN `tags` AS e ON d.tag_id=e.id
LEFT JOIN `subscription_types` AS f ON a.subsciption_type_id=f.id
GROUP BY a.id") );

         foreach($movies as $movie){
             if($movie->subs=='basic' or $user->usertypesuser->usersubscription->subscriptiontypes->name=='platinum'){
                 $movie->play = true;
             } else {
                 $rented = DB::select( DB::raw("SELECT count(id) AS 'num' FROM movie_rents WHERE movie_id = ".$movie->id."
AND user_id = ".$user->id."
AND license_start <= '".now()."'
AND license_end >= '".now()."'") );

                 if($rented[0]->num){
                     $movie->play = true;
                 } else {
                     $movie->play = false;
                 }
             }
             $result[]=$movie;

         }

        return view('viewallmovies', ['result' => $result,'usertype'=>$user->usertypesuser->usersubscription->subscriptiontypes->name]);

    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function playmovie($id)
    {
        $user = Auth::user();
        //check allowed to see movie
        //get movie details
        $show_movie = false;
        $movie='';
        $movies = DB::select( DB::raw("SELECT a.*,f.name AS 'subs' FROM movies AS a
LEFT JOIN `subscription_types` AS f ON a.subsciption_type_id=f.id
WHERE a.id=:id"),['id' => $id] );
        if(count($movies)>0){
            $movie=$movies[0];
            if($movies[0]->subs=='basic' or $user->usertypesuser->usersubscription->subscriptiontypes->name=='platinum'){
                $show_movie = true;
            } else {
                //check have rented
                $rented = DB::select( DB::raw("SELECT count(id) AS 'num' FROM movie_rents WHERE movie_id = ".$id."
AND user_id = ".$user->id."
AND license_start <= '".now()."'
AND license_end >= '".now()."'") );

                if($rented[0]->num){
                    $show_movie = true;
                } else {
                    $show_movie = false;
                }

            }
        }
        return view('playmovie', ['show_movie' => $show_movie,'movie'=>$movie]);


    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function rentmovie($id)
    {
        $user = Auth::user();
        //simple insert for rent
        $movies = DB::select( DB::raw("SELECT a.*,f.name AS 'subs' FROM movies AS a
LEFT JOIN `subscription_types` AS f ON a.subsciption_type_id=f.id
WHERE a.id=:id"),['id' => $id] );

        $currentDate = Carbon::now();

        $rent_end = $currentDate->addDays($movies[0]->rent_period);

        $movieid = DB::table('movie_rents')->insertGetId([
            'user_id' => $user->id,
            'movie_id' => $id,
            'license_start' => Carbon::now()->toDateString(),
            'license_end' => Carbon::parse($rent_end)->toDateString(),
            'created_at'=> now(),
            'updated_at'=> now()
        ]);
        return redirect()->route('movies')->with('success', 'Movie Rented!');

    }


    public function serachmoviebysubs(Request $request)
    {
        $user = Auth::user();
        $search_term = $request->searchterm;

        $movies = DB::select( DB::raw("SELECT a.*,GROUP_CONCAT(DISTINCT(c.name)) AS 'casts',GROUP_CONCAT(DISTINCT(e.name)) AS 'tags',f.name AS 'subs' FROM movies AS a
LEFT JOIN `movie_casts` AS b ON a.id=b.movie_id
LEFT JOIN `casts` AS c ON b.cast_id=c.id
LEFT JOIN `movie_tags` AS d ON a.id=d.movie_id
LEFT JOIN `tags` AS e ON d.tag_id=e.id
LEFT JOIN `subscription_types` AS f ON a.subsciption_type_id=f.id
WHERE (a.title LIKE :searchterm1 OR a.id IN (
SELECT movie_id FROM `movie_tags` WHERE tag_id IN (SELECT id FROM `tags` WHERE NAME LIKE :searchterm2  )
)
)
GROUP BY a.id "), ['searchterm1' => '%'.$search_term.'%','searchterm2' => '%'.$search_term.'%'] );
        // var_dump($movies);
        foreach($movies as $movie){
            if($movie->subs=='basic' or $user->usertypesuser->usersubscription->subscriptiontypes->name=='platinum'){
                $movie->play = true;
            } else {
                $rented = DB::select( DB::raw("SELECT count(id) AS 'num' FROM movie_rents WHERE movie_id = ".$movie->id."
AND user_id = ".$user->id."
AND license_start <= '".now()."'
AND license_end >= '".now()."'") );

                if($rented[0]->num){
                    $movie->play = true;
                } else {
                    $movie->play = false;
                }
            }
            $result[]=$movie;

        }

        return view('viewallmovies', ['result' => $result,'usertype'=>$user->usertypesuser->usersubscription->subscriptiontypes->name]);

    }

}
