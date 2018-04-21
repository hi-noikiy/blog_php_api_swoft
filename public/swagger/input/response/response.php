<?php
/**
 * @SWG\Definition(
 *   definition="ApiResponse",
 *   type="object",
 *   @SWG\Property(property="code",type="integer",description="code码",default="200"),
 *   @SWG\Property(property="res",type="object",description="返回数据"),
 *
 *   @SWG\Property(property="msg",type="string",description="msg" ,default="请求成功")
 * )
 */


/**
 * @SWG\Definition(
 *   definition="authResponse",
 *   type="object",
 *   @SWG\Property(property="code",type="integer",description="code码",default="200"),
 *   @SWG\Property(property="res",type="object",description="返回数据",
 *     @SWG\Property(property="access-token",type="string",description="access-token"),
 *      @SWG\Property(property="info",type="object",description="个人信息",
 *          ref="$/definitions/user_info",
 *      ),
 * ),
 *   @SWG\Property(property="msg",type="string",description="msg" ,default="请求成功")
 * )
 */