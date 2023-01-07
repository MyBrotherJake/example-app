<?php

namespace App\Http\Requests\Tweet;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 最大140文字
            'tweet' => 'required|max:140',
            'images' => 'array|max:4',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
    /**
     * Tweet
     */
    public function userId (): int
    {
        return $this->user()->id;
    }

    public function tweet (): string
    {
        return $this->input('tweet');
    }
    /**
     * Image
     */
    public function images(): array
    {
        return $this->file('images', []);
    }
}
