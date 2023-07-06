<?php

namespace App\Http\Controllers\Admin\Paper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\Category;
use App\Models\Board;
use App\Models\Template;
use App\Http\Requests\Paper\SavePaperRequest;
use Auth;


class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
             
        $papers = Template::all();
      
        return view('admin.template.index',compact('papers'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $subject = Subject::whereStatus(1)->get();
        $trees = Subject::whereStatus(1)->get();
        $trunks = Category::with('categories')->where('parent_id',null)->get();
         $classes = SchoolClass::whereStatus(1)->get();
        $boards =Board::where('is_state',0)->get();

        return view('admin.template.create',compact('subject','trees','trunks','classes','boards'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SavePaperRequest $request)
    {
       $data = $request->validated();
        $a['branch_id'] = $request->branch_id;
        $a['twig_id'] = $request->twig_id??null;
        $a['leaf_id'] = $request->leaf_id??null;
        $a['vein_id'] = $request->vein_id??null;
       $a['creater'] = Auth::user()->name;
       $data= $data+$a;
        $template =   Template::create($data);
       $template->number = $this->questionNumber($template);
       $template->update();

         return redirect()->route('template.index')->with('message','Paper Template created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paper = Template::with('subject','category','branch','class','twig','leaf','vein','board')->findOrFail($id);
        return view('admin.template.show',compact('paper'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   

        $paper = Template::findOrFail($id);
          $subject = Subject::whereStatus(1)->get();
        $trees = Subject::whereStatus(1)->get();
        $trunks = Category::with('categories')->where('parent_id',null)->get();
         $classes = SchoolClass::whereStatus(1)->get();
        $boards =Board::where('is_state',0)->get();
         $branches =Category::where('parent_id',$paper->category_id)->get();
        $twiges = Category::where('parent_id',$paper->branch_id )->get();
        $leaves = Category::where('parent_id',$paper->twig_id )->get();
        $veins = Category::where('parent_id',$paper->leaf_id)->get();
         $states =Board::where('is_state',1)->get();

        return view('admin.template.edit',compact('subject','trees','trunks','branches','twiges','leaves','veins','classes','boards','paper','states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SavePaperRequest $request, $id)
    {
        $paper = Template::findOrFail($id);
        $data =$request->validated();
        $a['branch_id'] = $request->branch_id;
        $a['twig_id'] = $request->twig_id??null;
        $a['leaf_id'] = $request->leaf_id??null;
        $a['vein_id'] = $request->vein_id??null;
$data= $data+$a;
        $paper->update($data);
        // $a['number'] = $this->questionNumber($paper);

        $paper->update(['number'=>$this->questionNumber($paper)]);
        
        // dd($data);
          return redirect()->route('template.index')->with('message','Paper Template  updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Template::destroy($id);
         return redirect()->route('template.index')->with('message','Paper Template deleted successfully');
    }

    public function get_category(Request $request)
    {
       $parent_id = $request->parent_id;
       $categories = Category::where('parent_id',$parent_id)->get();
       $html = ' <option value="">--Select '.ucfirst($request->type).'--</option>';
       if($categories->count() > 0 && $parent_id){
       foreach ($categories as  $category) {
          
          $html .= '<option value="'.$category->id.'">'.$category->name.'</option>';
       }

   }  else {
     
    $html .= '<option value="">None</option>';
   }

          return response()->json(['success'=>true,'html'=>$html]);

    }


    public function get_board(Request $request)
    {
       $board_id = $request->board_id;
       $board = Board::find($board_id);
   
       $html = '<select  name="state_id" class="form-control" ><option>--Select Board--</option>';
       if($board->is_board == 0){

        $boards = Board::where('is_state',1)->get();
       foreach ($boards as  $board) {
          
          $html .= '<option value="'.$board->id.'">'.$board->name.'</option>';
       }
       $html .='</select>';
          return response()->json(['success'=>true,'html'=>$html]);
           }  else {
             
             return response()->json(['success'=>false]);
           }


    }

       public function generate(string $name) : string
    {
        $words = explode(' ', $name);
        if (count($words) >= 2) {
            if(preg_match_all('/\b(\w)/',strtoupper($name),$m)) {
              return  $v = implode('',$m[1]); // $v is now SOQTU
            }          
       
        }
        return $this->makeInitialsFromSingleWord($name);
    }

    /**
     * Make initials from a word with no spaces
     *
     * @param string $name
     * @return string
     */
    protected function makeInitialsFromSingleWord(string $name) : string
    {
        preg_match_all('#([A-Z]+)#', $name, $capitals);
        if (count($capitals[1]) >= 2) {
            return substr(implode('', $capitals[1]), 0, 2);
        }
        return strtoupper(substr($name, 0, 2));
    }

    protected function questionNumber($template){
        $number = 'QP'.$template->id;
         if($template->subject_id){
            $number .= '-'.$this->generate($template->subject->name); 
        }
        if($template->category_id){
            $number .= '-'.$this->generate($template->category->name); 
        }
         if($template->branch_id){
            $number .= '-'.$this->generate($template->branch->name); 
        }
         if($template->twig_id){
            $number .= '-'.$this->generate($template->twig->name); 
        }
         if($template->leaf_id){
            $number .= '-'.$this->generate($template->leaf->name); 
        }
         if($template->vein_id){
            $number .= '-'.$this->generate($template->vein->name); 
        }

        // dd($number);
        return $number;


    }
}
