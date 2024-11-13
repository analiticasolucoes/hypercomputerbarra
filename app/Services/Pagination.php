<?php

namespace App\Services;

class Pagination {
    private $url;
    private $totalItems;
    private $itemsPerPage;
    private $currentPage;
    
    public function __construct($url, $totalItems, $itemsPerPage = 15, $currentPage = 1) {
        $this->url = $url;
        $this->totalItems = $totalItems;
        $this->itemsPerPage = $itemsPerPage;
        $this->currentPage = $currentPage;
    }

    public function getTotalItems() {
        return $this->totalItems;
    }

    public function getItemsPerPage() {
        return $this->itemsPerPage;
    }

    public function getCurrentPage() {
        return $this->currentPage;
    }

    public function getTotalPages() {
        return ceil($this->totalItems / $this->itemsPerPage);
    }

    public function getStartIndex() {
        return ($this->currentPage - 1) * $this->itemsPerPage;
    }

    public function getEndIndex() {
        return min($this->totalItems, $this->getStartIndex() + $this->itemsPerPage);
    }

    public function nextPage() {
        if ($this->currentPage < $this->getTotalPages()) {
            $this->currentPage++;
        }
    }

    public function prevPage() {
        if ($this->currentPage > 1) {
            $this->currentPage--;
        }
    }

    public function setPage($page) {
        if ($page > 0 && $page <= $this->getTotalPages()) {
            $this->currentPage = $page;
        }
    }

    public function getPaginatedItems($items) {
        $start = $this->getStartIndex();
        $end = $this->getEndIndex();
        return array_slice($items, $start, $end - $start);
    }

    public function getNavigation($searchVariavel = "", $searchParametre = "", $parametrosAdicionais = []) {
        $totalPages = $this->getTotalPages();
        $currentPage = $this->getCurrentPage();
        $navigation = [];

        if ($totalPages > 1) {
            // Link para a Primeira página
            if ($currentPage > 1) {
                $navigation[] = [
                    "label" => "Primeira",
                    "page" => 1,
                    "active" => true
                ];
            } else {
                $navigation[] = [
                    "label" => "Primeira",
                    "page" => 0,
                    "active" => false
                ];
            }
            

            // Link para a página Anterior
            if ($currentPage > 1) {
                $navigation[] = [
                    "label" => "Anterior",
                    "page" => ($currentPage - 1),
                    "active" => true
                ];
            } else {
                $navigation[] = [
                    "label" => "Anterior",
                    "page" => 0,
                    "active" => false
                ];
            }

            // Links para as páginas numeradas (5 páginas próximas)
            $start = max(1, $currentPage - 2);
            $end = min($totalPages, $currentPage + 2);

            for ($i = $start; $i <= $end; $i++) {
                if ($i == $currentPage) {
                    $navigation[] = [
                        "label" => "<strong>" . $i . "</strong>",
                        "page" => $i,
                        "active" => false
                    ];
                } else {
                    $navigation[] = [
                        "label" => $i,
                        "page" => $i,
                        "active" => true
                    ];
                }
            }

            // Link para a Próxima página
            if ($currentPage < $totalPages) {
                $navigation[] = [
                    "label" => "Próxima",
                    "page" => ($currentPage + 1),
                    "active" => true
                ];
            } else {
                $navigation[] = [
                    "label" => "Próxima",
                    "page" => 0,
                    "active" => false
                ];
            }

            // Link para a Última página
            if ($currentPage < $totalPages) {
                $navigation[] = [
                    "label" => "Última",
                    "page" => $totalPages,
                    "active" => true
                ];
            } else {
                $navigation[] = [
                    "label" => "Última",
                    "page" => 0,
                    "active" => false
                ];
            }
        }

        return $navigation;
    }
}