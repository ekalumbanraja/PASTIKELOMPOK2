package controller

import (
	"net/http"
	"strconv"

	"github.com/ErlanggaWebdev/category-service/dto"
	"github.com/ErlanggaWebdev/category-service/helper"
	"github.com/ErlanggaWebdev/category-service/models"
	"github.com/ErlanggaWebdev/category-service/service"
	"github.com/gin-gonic/gin"
)

// CategoryController is a contract about something that this controller can do
type CategoryController interface {
	All(ctx *gin.Context)
	FindByID(ctx *gin.Context)
	Insert(ctx *gin.Context)
	Update(ctx *gin.Context)
	Delete(ctx *gin.Context)
}

type categoryController struct {
	CategoryService service.CategoryService
}

// NewCategoryController creates a new instance of CategoryController
func NewCategoryController(CategoryService service.CategoryService) CategoryController {
	return &categoryController{
		CategoryService: CategoryService,
	}
}

func (c *categoryController) All(ctx *gin.Context) {
	categories := c.CategoryService.All()
	ctx.JSON(http.StatusOK, categories)
}

func (c *categoryController) FindByID(ctx *gin.Context) {
	idStr := ctx.Param("id")
	id, err := strconv.ParseUint(idStr, 10, 64)
	if err != nil {
		res := helper.BuildErrorResponse("Failed to get ID", "No param ID were found", helper.EmptyObj{})
		ctx.JSON(http.StatusBadRequest, res)
		return
	}

	category := c.CategoryService.FindByID(id)
	if category.ID == 0 {
		res := helper.BuildErrorResponse("Data not found", "No data with given ID", helper.EmptyObj{})
		ctx.JSON(http.StatusNotFound, res)
		return
	}

	ctx.JSON(http.StatusOK, category)
}

func (c *categoryController) Insert(ctx *gin.Context) {
	var categoryCreateDTO dto.CategoryCreateDTO
	errDTO := ctx.ShouldBind(&categoryCreateDTO)
	if errDTO != nil {
		res := helper.BuildErrorResponse("Failed to process request", errDTO.Error(), helper.EmptyObj{})
		ctx.JSON(http.StatusBadRequest, res)
		return
	}
	result := c.CategoryService.Insert(categoryCreateDTO)
	response := helper.BuildResponse(true, "OK!", result)
	ctx.JSON(http.StatusCreated, response)
}

func (c *categoryController) Update(ctx *gin.Context) {
	var categoryUpdateDTO dto.CategoryUpdateDTO
	errDTO := ctx.ShouldBind(&categoryUpdateDTO)
	if errDTO != nil {
		res := helper.BuildErrorResponse("Failed to process request", errDTO.Error(), helper.EmptyObj{})
		ctx.JSON(http.StatusBadRequest, res)
		return
	}
	idStr := ctx.Param("id")
	id, errID := strconv.ParseUint(idStr, 10, 64)
	if errID != nil {
		res := helper.BuildErrorResponse("Failed to get ID", "No param ID were found", helper.EmptyObj{})
		ctx.JSON(http.StatusBadRequest, res)
		return
	}
	categoryUpdateDTO.ID = uint(id) // Convert id to uint
	result := c.CategoryService.Update(categoryUpdateDTO)
	response := helper.BuildResponse(true, "OK!", result)
	ctx.JSON(http.StatusOK, response)
}

func (c *categoryController) Delete(ctx *gin.Context) {
	var category models.Category
	idStr := ctx.Param("id")
	id, err := strconv.ParseUint(idStr, 10, 64)
	if err != nil {
		res := helper.BuildErrorResponse("Failed to get ID", "No param ID were found", helper.EmptyObj{})
		ctx.JSON(http.StatusBadRequest, res)
		return
	}
	category.ID = uint(id)
	c.CategoryService.Delete(category)
	res := helper.BuildResponse(true, "Deleted", helper.EmptyObj{})
	ctx.JSON(http.StatusOK, res)
}
