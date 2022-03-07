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
 *         response=500,
 *         description="伺服器錯誤",
 *     ),
 * )
 */

/**
 * @OA\Get(
 *     path="/api/currencies/covert",
 *     operationId="轉換貨幣",
 *     tags={"Currency 貨幣"},
 *     summary="轉換貨幣",
 *     description="轉換貨幣",
 *     @OA\Parameter(
 *         name="from",
 *         in="query",
 *         example="USD",
 *         description="原始貨幣 允許輸入TWD,JPY,USD",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="to",
 *         in="query",
 *         example="TWD",
 *         description="兌換貨幣 允許輸入TWD,JPY,USD",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="amount",
 *         in="query",
 *         example=1000,
 *         description="原始貨幣數量, 最大上限1,000,000,000,000,000, 最小 0.01",
 *         required=true,
 *         @OA\Schema(
 *             type="double",
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="回傳兌換後的結果",
 *         @OA\JsonContent(
 *             @OA\Property(property="source_amount", type="string", example="1.25"),
 *             @OA\Property(property="target_amount", type="string", example="4.58625"),
 *             @OA\Property(property="from", type="string", example="TWD"),
 *             @OA\Property(property="to", type="string", example="JPY"),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="輸入錯誤",
 *         @OA\JsonContent(
 *             @OA\Property(property="return_message", type="string", example="The selected from is invalid."),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="伺服器錯誤",
 *     ),
 * )
 */