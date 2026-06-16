<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\VisitorLogModel;

class VisitorLogFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $logModel = new VisitorLogModel();


        $category = null;
        $productId = null;

        /*
          Example URLs
          /dress/all-dresses   -> $segment1 = 'dress', $segment2 = 'all-dresses'
          /dress/casual        -> $segment1 = 'dress', $segment2 = 'casual'
          /dress-details/2     -> $segment1 = 'dress-details', $segment2 = '2'
          /                    -> $segment1 = '', $segment2 = '' (Safe fallback)
        */
        // 1. Fetch all available segments as a clean PHP array
        $segments = $request->getUri()->getSegments();

        // 2. Safely extract values using standard PHP null-coalescing (??)
        // Remember: getSegments() returns a 0-indexed array!
        $segment1 = $segments[0] ?? '';
        $segment2 = $segments[1] ?? '';

        // Category pages
        if ($segment1 === 'dress' && $segment2 !== '') {
            $category = $segment2;
        }

        // Product details page
        if ($segment1 === 'dress-details' && $segment2 !== '') {
            $productId = $segment2;
        }

        // 30-second anti-spam check for matching IP and exact URL
        $existing = $logModel
            ->where('ip_address', $request->getIPAddress())
            ->where('page_url', current_url())
            ->where('visited_at >=', date('Y-m-d H:i:s', strtotime('-30 seconds')))
            ->first();

        if (!$existing) {
            $logModel->insert([
                'ip_address' => $request->getIPAddress(),
                'page_url' => current_url(),
                'category' => $category,
                'product_id' => $productId,
                'user_agent' => \Config\Services::request()->getUserAgent()->getAgentString(),
            ]);
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
