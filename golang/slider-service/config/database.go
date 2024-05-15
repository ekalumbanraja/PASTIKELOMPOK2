package config

import (
	"SLIDER-SERVICE/models"
	"log"

	"gorm.io/driver/mysql"
	"gorm.io/gorm"
)

var DB *gorm.DB

func ConnectDatabase() {
    dsn := "root:@tcp(127.0.0.1:3306)/services_slider?charset=utf8mb4&parseTime=True&loc=Local"
    db, err := gorm.Open(mysql.Open(dsn), &gorm.Config{})
    if err != nil {
        log.Fatal("Failed to connect to database:", err)
    }

    DB = db
    AutoMigrate()
}

func AutoMigrate() {
    err := DB.AutoMigrate(&models.Slider{})
    if err != nil {
        log.Fatal("Failed to migrate database:", err)
    }
}

