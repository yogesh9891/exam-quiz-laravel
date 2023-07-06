<?php

namespace App\Http\Livewire\Book;

use Livewire\Component;
use App\Models\Book as SchoolBook;

class Book extends Component
{

    public $books,$title,$sub_title,$publisher,$isbn,$publication_year,$chapter_source,$chapter_title,$book_id= '';
    public $isOpen = 0;
    public $confirming = null;


    public function render()
    {

        $this->books = SchoolBook::all();
        return view('livewire.book.book');
    }

     public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }
    

    public function openModal()
    {
        $this->isOpen = true;
    }
    
    public function closeModal()
    {
        $this->isOpen = false;
    }


    private function resetInputFields(){
        $this->title ='';
        $this->sub_title='';
        $this->publisher='';
        $this->isbn='';
        $this->publication_year='';
        $this->chapter_source='';
        $this->chapter_title='';
    }


        public function store()
    {
        $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'sub_title' => ['required', 'string', 'max:255'],
            'chapter_title' => ['required', 'string', 'max:255'],
            'publisher' => ['required', 'string', 'max:255'],
            'isbn' => ['required', 'string', 'max:255'],
            'chapter_source' => ['required', 'numeric'],
            'publication_year' => ['required', 'string', 'max:255','date_format:Y'],
        ]);
   
   
        $data = SchoolBook::updateOrCreate(['id' => !strlen($this->book_id)? null : $this->book_id], [
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            'publisher' => $this->publisher,
            'isbn' => $this->isbn,
            'chapter_source' => $this->chapter_source,
            'chapter_title' => $this->chapter_title,
            'publication_year' => $this->publication_year,
        ]);


  
        session()->flash('message', 
            $this->book_id ? 'Book Updated Successfully.' : 'Book Created Successfully.');
  
        $this->closeModal();
        $this->resetInputFields();
    }


    public function edit($id)
    {
        $class = SchoolBook::findOrFail($id);
        $this->book_id = $id;
        $this->title = $class->title;
        $this->sub_title = $class->sub_title;
        $this->publisher = $class->publisher;
        $this->isbn = $class->isbn;
        $this->chapter_source = $class->chapter_source;
        $this->chapter_title = $class->chapter_title;
        $this->publication_year = $class->publication_year;
        $this->openModal();
    }




    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }  


    public function cancelDlt()
    {
        $this->confirming = null;
    }


    public function delete($id)
    {
        SchoolBook::find($id)->delete();
        session()->flash('message', 'Book Deleted Successfully.');
    }

}
