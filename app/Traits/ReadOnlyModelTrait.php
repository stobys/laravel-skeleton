<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Exceptions\ReadOnlyModelException;

trait ReadOnlyModelTrait {

    /**
     * throws App\Exceptions\ReadOnlyModelException on create
     *
     * @method create
     * @param  array  $attributes
     *
     * @throws App\Exceptions\ReadOnlyModelException
     */
    static function create(array $attributes = [])
    {
        throw (new ReadOnlyModelException) -> setModel( get_called_class() );
    }

    /**
     * returns false on forceCreate
     * @method forceCreate
     * @param  array       $attributes
     * @return false
     */
    static function forceCreate(array $attributes){
        throw (new ReadOnlyModelException) -> setModel( get_called_class() );
    }

    /**
     * returns false on save
     * @method save
     * @param  array $options
     * @return false
     */
    public function save(array $options = []){
        throw (new ReadOnlyModelException) -> setModel( get_called_class() );
    }

    /**
     * returns false on update
     * @method update
     * @param  [type] $attributes
     * @param  [type] $options
     * @return false
     */
    public function update(array $attributes = [], array $options = []){
        throw (new ReadOnlyModelException) -> setModel( get_called_class() );
    }

    /**
     * returns false on firstOrCreate
     *
     * @method firstOrCreate
     * @param  array         $arr
     * @return false
     */
    static function firstOrCreate(array $arr){
        throw (new ReadOnlyModelException) -> setModel( get_called_class() );
    }

    /**
     * returns false on firstOrNew
     *
     * @method firstOrNew
     * @param  array      $arr
     * @return false
     */
    static function firstOrNew(array $arr){
        throw (new ReadOnlyModelException) -> setModel( get_called_class() );
    }

/**
 * returns false on delete
 * @method delete
 * @return false
 */
  public function delete(){
    throw (new ReadOnlyModelException) -> setModel( get_called_class() );
  }
/**
 * returns false on destroy
 * @method destroy
 * @param  mixed  $ids
 * @return false
 */
  static function destroy($ids){
    throw (new ReadOnlyModelException) -> setModel( get_called_class() );
  }
/**
 * returns false on restore
 * @method restore
 * @return false
 */
  public function restore(){
    throw (new ReadOnlyModelException) -> setModel( get_called_class() );
  }
/**
 * returns false on forceDelete
 * @method forceDelete
 * @return false
 */
  public function forceDelete(){
    throw (new ReadOnlyModelException) -> setModel( get_called_class() );
  }
  /**
   * returns false on performDeleteOnModel
   * @method performDeleteOnModel
   * @return false
   */
    public function performDeleteOnModel(){
      throw (new ReadOnlyModelException) -> setModel( get_called_class() );
    }
  /**
   * returns false on push
   * @method push
   * @return false
   */
    public function push(){
      throw (new ReadOnlyModelException) -> setModel( get_called_class() );
    }
  /**
   * returns false on finishSave
   * @method finishSave
   * @return false
   */
    public function finishSave(array $options){
      throw (new ReadOnlyModelException) -> setModel( get_called_class() );
    }
  /**
   * returns false on performUpdate
   * @method performUpdate
   * @return false
   */
    public function performUpdate(Builder $query, array $options = []){
      throw (new ReadOnlyModelException) -> setModel( get_called_class() );
    }
  /**
   * returns false on touch
   * @method touch
   * @return false
   */
    public function touch(){
      throw (new ReadOnlyModelException) -> setModel( get_called_class() );
    }
}