<?php
/**
 * @SWG\Post(
 *   path="/v1/auth/signin",
 *   summary="登录",
 *     tags={"auth"},
 *     description="登录",
 *     @SWG\Parameter(
 *         description="1-密码登录; 2-手机验证码登录.登录方式",
 *         in="formData",
 *         format="int",
 *         name="login_type",
 *         required=true,
 *         type="integer",
 *     ),
 *     @SWG\Parameter(
 *         description="手机号",
 *         in="formData",
 *         format="string",
 *         name="mobile",
 *         required=true,
 *         type="string",
 *     ),
 *     @SWG\Parameter(
 *         description="密码  login_type为1时必填",
 *         in="formData",
 *         format="string",
 *         name="password",
 *         required=false,
 *         type="string",
 *     ),
 *     @SWG\Parameter(
 *         description="短信验证码 login_type为2时必填",
 *         in="formData",
 *         format="string",
 *         name="sms_code",
 *         required=false,
 *         type="string",
 *     ),
 *     consumes={"multipart/form-data","application/x-www-form-urlencoded"},
 *     produces={"application/json"},
 *     @SWG\Response(
 *          response=200,
 *          description="Example extended response",
 *          ref="$/responses/Json",
 *          @SWG\Schema(
 *              ref="#/definitions/authResponse",
 *              @SWG\Property(
 *                  property="data",
 *                  ref="#/definitions/user_info"
 *              )
 *          )
 *     ),
 *     @SWG\Response(response=2002, description="不合法的参数,缺少参数")
 * )
 */

/**
 * @SWG\Post(
 *   path="/v1/auth/signup",
 *     summary="注册",
 *     tags={"auth"},
 *     description="注册",
 *     @SWG\Parameter(
 *         description="手机号",
 *         in="formData",
 *         format="string",
 *         name="mobile",
 *         required=true,
 *         type="string",
 *     ),
 *     @SWG\Parameter(
 *         description="密码",
 *         in="formData",
 *         format="string",
 *         name="password",
 *         required=true,
 *         type="string",
 *     ),
 *     @SWG\Parameter(
 *         description="短信验证码 sms/send接口获取 type=2",
 *         in="formData",
 *         format="string",
 *         name="sms_code",
 *         required=true,
 *         type="string",
 *     ),
 *     consumes={"multipart/form-data","application/x-www-form-urlencoded"},
 *     produces={"application/json"},
 *     @SWG\Response(
 *         response="200",
 *         description="返回成功",
 *         @SWG\Items(ref="#/definitions/authResponse"),
 *     ),
 * )
 */