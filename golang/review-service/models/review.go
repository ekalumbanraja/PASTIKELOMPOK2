package models

import "gorm.io/gorm"

type Review struct {
	gorm.Model
	Title   string `json:"title"`
	Content string `json:"content"`
	Rating  int    `json:"rating"`
}
