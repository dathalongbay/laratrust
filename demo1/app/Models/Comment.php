<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $primaryKey = 'id';

    protected $fillable = [
        'comment_title',
        'comment_content',
        'post_id'
    ];

    // 1 comment thuộc 1 post
    public function post() {
        return $this->belongsTo(Post::class);
    }
}
