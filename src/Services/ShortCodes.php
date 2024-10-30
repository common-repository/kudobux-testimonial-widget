<?php

namespace Kudobuzz\Services;

class ShortCodes
{
    /**
     * Full page
     * @param [type] $atts
     * @return void
     */
    public function fullpage($atts)
    {
        $kudobuzz_fullpage_tag = '';
        $kudobuzz_fullpage_tag .= Storage::get('kudobuzz_fullpage_widget');

        return $kudobuzz_fullpage_tag;
    }
    
    /**
     * Slider
     *
     * @param [type] $atts
     * @return void
     */
    public function slider($atts)
    {
        $kudobuzz_slider_tag = '';
        $kudobuzz_slider_tag .= Storage::get('kudobuzz_slider_widget');

        return $kudobuzz_slider_tag;
    }

    /**
     * Badge shortcode
     *
     * @param [type] $atts
     * @return void
     */
    public function badge($atts)
    {
        $kudobuzz_badge_tag = '';
        $kudobuzz_badge_tag .= Storage::get('kudobuzz_badge_widget');

        return $kudobuzz_badge_tag;
    }

    /**
     * Page reviews
     *
     * @param [type] $atts
     * @return void
     */
    public function page_review($atts)
    {
        $kudobuzz_slider_tag = '';
        $kudobuzz_slider_tag .= Storage::get('kudobuzz_review_widget');

        return $kudobuzz_slider_tag;
    }

    /**
     * Site rich snippet
     *
     * @param [type] $attss
     * @return void
     */
    public function site_rich_snippet()
    {
        return '
        <div style="position: absolute; left: -1000px; top: -1000px; z-index: 0" itemprop="aggregateRating" itemscope itemtype=' .'"http://schema.org/AggregateRating">'.
            '<meta itemprop="itemReviewed" content="' . get_site_url(). '">
            <span itemprop="ratingValue">' . Storage::get('kudobuzz_ratingValue') . '</span>
            <span itemprop="ratingCount">' . Storage::get('kudobuzz_ratingCount') . '</span>
        </div>';
    }
}