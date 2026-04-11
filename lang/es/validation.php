<?php

return [
    'accepted' => 'El campo :attribute debe ser aceptado.',
    'active_url' => 'El campo :attribute debe ser una URL valida.',
    'after' => 'El campo :attribute debe ser una fecha posterior a :date.',
    'alpha' => 'El campo :attribute solo debe contener letras.',
    'alpha_num' => 'El campo :attribute solo debe contener letras y numeros.',
    'array' => 'El campo :attribute debe ser un array.',
    'between' => [
        'file' => 'El campo :attribute debe estar entre :min y :max kilobytes.',
        'numeric' => 'El campo :attribute debe estar entre :min y :max.',
        'string' => 'El campo :attribute debe tener entre :min y :max caracteres.',
        'array' => 'El campo :attribute debe contener entre :min y :max elementos.',
    ],
    'confirmed' => 'La confirmacion del campo :attribute no coincide.',
    'email' => 'El campo :attribute debe ser un correo electronico valido.',
    'image' => 'El campo :attribute debe ser una imagen.',
    'max' => [
        'file' => 'El campo :attribute no debe ser mayor que :max kilobytes.',
        'numeric' => 'El campo :attribute no debe ser mayor que :max.',
        'string' => 'El campo :attribute no debe ser mayor que :max caracteres.',
        'array' => 'El campo :attribute no debe contener mas de :max elementos.',
    ],
    'min' => [
        'file' => 'El campo :attribute debe ser de al menos :min kilobytes.',
        'numeric' => 'El campo :attribute debe ser al menos :min.',
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
        'array' => 'El campo :attribute debe contener al menos :min elementos.',
    ],
    'numeric' => 'El campo :attribute debe ser un numero.',
    'required' => 'El campo :attribute es obligatorio.',
    'string' => 'El campo :attribute debe ser una cadena de texto.',
    'unique' => 'El campo :attribute ya ha sido usado.',
    'uploaded' => 'La carga del campo :attribute ha fallado.',

    'attributes' => [
        'title' => 'titulo',
        'description' => 'descripcion',
        'price' => 'precio',
        'category' => 'categoria',
        'temporary_images' => 'imagenes',
        'temporary_images.*' => 'imagen',
        'email' => 'email',
        'password' => 'contrasena',
        'name' => 'nombre',
        'message' => 'mensaje',
    ],
];
