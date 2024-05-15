package config

import (
	"log"
	"os"

	"gorm.io/driver/mysql"
	"gorm.io/gorm"

	"github.com/joho/godotenv"
)

var DB *gorm.DB

func ConnectDB() {
	err := godotenv.Load()
	if err != nil {
		log.Fatal("Error loading .env file")
	}

	dsn := os.Getenv("DB_DSN")
	if dsn == "" {
		log.Fatal("DB_DSN is not set in .env file")
	}

	database, err := gorm.Open(mysql.Open(dsn), &gorm.Config{})
	if err != nil {
		log.Fatal("Failed to connect to database!", err)
	}

	DB = database
}



// func ConnectDB() {
//     dsn := "user:@tcp(127.0.0.1:3306)/services_employe?charset=utf8mb4&parseTime=True&loc=Local"
//     var err error
//     DB, err = gorm.Open(mysql.Open(dsn), &gorm.Config{})
//     if err != nil {
//         panic("Failed to connect to database")
//     }
// }

