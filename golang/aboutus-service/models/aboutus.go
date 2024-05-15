package models

type AboutUs struct {
	ID      uint   `gorm:"primaryKey"`
	Title   string `gorm:"size:255"`
	Content string `gorm:"type:text"`
}