<?php
/**
 * @OA\Get(
 *     path="/api/currencies",
 *     operationId="取得貨幣完整資訊",
 *     tags={"Currency 貨幣"},
 *     summary="取得貨幣完整資訊",
 *     description="取得貨幣完整資訊",
 *     @OA\Response(
 *         response=200,
 *         description="取得貨幣完整資訊",
 *         @OA\JsonContent(
 *             @OA\Property(property="currencies", type="object",
 *                 @OA\Property(property="TWD", type="object",
 *                     @OA\Property(property="TWD", type="double", example=1),
 *                     @OA\Property(property="JPY", type="double", example=3.669),
 *                     @OA\Property(property="USD", type="double", example=0.03281),
 *                 ),
 *                 @OA\Property(property="JPY", type="object",
 *                     @OA\Property(property="TWD", type="double", example=0.26956),
 *                     @OA\Property(property="JPY", type="double", example=1),
 *                     @OA\Property(property="USD", type="double", example=0.00885),
 *                 ),
 *                 @OA\Property(property="USD", type="object",
 *                     @OA\Property(property="TWD", type="double", example=30.444),
 *                     @OA\Property(property="JPY", type="double", example=111.801),
 *                     @OA\Property(property="USD", type="double", example=1),
 *                 ),
 *             ),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="貨幣不存在",
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="伺服器錯誤",
 *         @OA\JsonContent(
 *             @OA\Property(property="return_message", type="string",
 *                 example="Exception"
 *             ),
 *         ),
 *     ),
 * )
 */