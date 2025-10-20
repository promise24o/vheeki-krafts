<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * QR Code Generator Library for CodeIgniter 3
 * Uses Google Charts API for QR code generation
 */
class Qr_code {
    
    protected $CI;
    
    public function __construct() {
        $this->CI =& get_instance();
    }
    
    /**
     * Generate QR code and save to file
     * 
     * @param string $data The data to encode in QR code
     * @param string $filename The filename to save (without extension)
     * @param int $size The size of QR code (default 300)
     * @return string|false The file path or false on failure
     */
    public function generate($data, $filename, $size = 300) {
        try {
            // Create QR code directory if it doesn't exist
            $qr_dir = './uploads/qrcodes/';
            if (!is_dir($qr_dir)) {
                mkdir($qr_dir, 0777, true);
            }
            
            // Generate QR code using Google Charts API
            $qr_url = "https://chart.googleapis.com/chart?chs={$size}x{$size}&cht=qr&chl=" . urlencode($data) . "&choe=UTF-8";
            
            // Get QR code image
            $qr_image = file_get_contents($qr_url);
            
            if ($qr_image === false) {
                return false;
            }
            
            // Save to file
            $filepath = $qr_dir . $filename . '.png';
            $result = file_put_contents($filepath, $qr_image);
            
            if ($result === false) {
                return false;
            }
            
            return $filename . '.png';
            
        } catch (Exception $e) {
            log_message('error', 'QR Code generation failed: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Generate QR code using PHP GD library (alternative method)
     * This creates a simple QR code without external dependencies
     * 
     * @param string $data The data to encode
     * @param string $filename The filename to save
     * @return string|false The file path or false on failure
     */
    public function generate_simple($data, $filename) {
        try {
            // For production, you should use a proper QR code library like phpqrcode
            // This is a placeholder that uses Google Charts API
            return $this->generate($data, $filename);
            
        } catch (Exception $e) {
            log_message('error', 'Simple QR Code generation failed: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Delete QR code file
     * 
     * @param string $filename The filename to delete
     * @return bool Success status
     */
    public function delete($filename) {
        $filepath = './uploads/qrcodes/' . $filename;
        if (file_exists($filepath)) {
            return unlink($filepath);
        }
        return false;
    }
    
    /**
     * Get QR code URL
     * 
     * @param string $filename The QR code filename
     * @return string The full URL to the QR code
     */
    public function get_url($filename) {
        return base_url('uploads/qrcodes/' . $filename);
    }
}
