# REPOSITORIO DE NOTAS 

https://github.com/Mwly-01/laravel-examples.git

# 🎴 Laravel Card Favorites System

Sistema de favoritos para tarjetas educativas desarrollado con Laravel, permitiendo a los estudiantes marcar y gestionar sus tarjetas más importantes para un acceso rápido.

## 📋 Tabla de Contenidos

- [Descripción](#descripción)
- [Características](#características)
- [Requisitos Previos](#requisitos-previos)
- [Instalación](#instalación)
- [Estructura del Proyecto](#estructura-del-proyecto)
- [Implementación](#implementación)
- [API Endpoints](#api-endpoints)
- [Contribuir](#contribuir)

---

## 📖 Descripción

Este proyecto implementa un sistema de favoritos que permite a los estudiantes guardar tarjetas educativas importantes. Utiliza una relación muchos-a-muchos entre usuarios y tarjetas, almacenando las preferencias en una tabla pivote.

### Contexto

Los estudiantes necesitan poder marcar las tarjetas que consideren más útiles o importantes como favoritas, facilitando el acceso rápido a contenido relevante durante su aprendizaje diario.

---

## ✨ Características

- ⭐ **Agregar favoritos**: Los usuarios pueden marcar tarjetas como favoritas
- 📚 **Listar favoritos**: Visualización de todas las tarjetas favoritas del usuario
- 🛡️ **Validación única**: Previene duplicados - una tarjeta solo puede ser favorita una vez por usuario
- 🔗 **Relación muchos-a-muchos**: Implementación eficiente usando tabla pivote
- 🌿 **Desarrollo en rama**: Trabajo organizado en `feature/examen-05`

---

## 🔧 Requisitos Previos

- PHP >= 8.1
- Composer
- Laravel >= 10.x
- MySQL/PostgreSQL
- Git

---
