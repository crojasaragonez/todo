<?php

class Task extends Eloquent {
    protected $table      = 'tasks';
    protected $fillable   = array('title', 'description', 'status');
    protected $guarded    = array('id');
    public    $timestamps = false;
}
