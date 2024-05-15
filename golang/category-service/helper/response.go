package helper

import (
	"strings"
)

// Response adalah struktur yang digunakan untuk membentuk respons JSON.
type Response struct {
	Status  bool        `json:"status"`  // Menunjukkan status keberhasilan atau kegagalan respons.
	Message string      `json:"message"` // Pesan yang menjelaskan status atau hasil operasi.
	Errors  interface{} `json:"errors"`  // Daftar pesan kesalahan jika ada.
	Data    interface{} `json:"data"`    // Data yang akan dimasukkan dalam respons.
}

// EmptyObj adalah objek yang digunakan ketika data tidak ingin menjadi null dalam JSON.
type EmptyObj struct{}

// BuildResponse digunakan untuk membuat respons sukses.
func BuildResponse(status bool, message string, data interface{}) Response {
	res := Response{
		Status:  status,
		Message: message,
		Errors:  nil,
		Data:    data,
	}
	return res
}

// BuildErrorResponse digunakan untuk membuat respons gagal.
func BuildErrorResponse(message string, err string, data interface{}) Response {
	// Memisahkan pesan kesalahan berdasarkan baris.
	splitedError := strings.Split(err, "\n")
	res := Response{
		Status:  false,
		Message: message,
		Errors:  splitedError,
		Data:    data,
	}
	return res
}
