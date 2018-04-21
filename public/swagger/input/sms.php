<?php
/**
 * @SWG\Post(
 *   path="/v1/sms/send",
 *     tags={"sms"},
 *     description="手机验证发送",
 *     @SWG\Parameter(
 *         description="1-登陆; 2-注册.3-,4-绑定(换绑),5-第三方绑定 短信一样 不验证手机号码是否存在",
 *         in="formData",
 *         format="int",
 *         name="type",
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
 *     consumes={"multipart/form-data","application/x-www-form-urlencoded"},
 *     produces={"application/json"},
 *     @SWG\Response(
 *         response="200",
 *         description="返回成功"
 *     ),
 * )
 */