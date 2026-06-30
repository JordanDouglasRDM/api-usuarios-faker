<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstName = fake()->firstName();
        $lastName = fake()->lastName();

        $safeEmail = fake()->unique()->safeEmail();
        $exploded = explode('@', $safeEmail);
        $safeEmail = Str::random(5). '_' . $exploded[0] . '@' . $exploded[1];
        return [
            'first_name'        => $firstName,
            'last_name'         => $lastName,
            'username'          => fake()->unique()->userName(),
            'phone_number'      => fake()->phoneNumber(),
            'profile_picture'   => fake()->randomElement($this->getImages()),
            'birthday_date'     => fake()->date('Y-m-d', '-18 years'),
            'gender'            => fake()->randomElement(['Male', 'Female', 'Other']),
            'country'           => fake()->country(),
            'city'              => fake()->city(),
            'email'             => $safeEmail,
            'password'          => static::$password ??= Hash::make('password'),
        ];
    }

    public function getImages(): array
    {
        return [
            'https://fastly.picsum.photos/id/390/640/480.jpg?hmac=0CnnGOCVHe1YPiCw71fcPqy3oNGldxN0Ch1vgB4xLgQ',
            'https://fastly.picsum.photos/id/378/640/480.jpg?hmac=prlp5jLEbkWfo3zh8RSSV0fNmPLm8bSSBzMws4Rstvw',
            'https://fastly.picsum.photos/id/999/640/480.jpg?hmac=naFgrGGXwpXQq7-BKZdl1g3QWTZrqfaLtxpcoYCii94',
            'https://fastly.picsum.photos/id/650/640/480.jpg?hmac=d2fL_ozW3D990ik4CvdUD8siub43FdQaM-zthCLwXEo',
            'https://fastly.picsum.photos/id/375/640/480.jpg?hmac=vstvr3BsojYOw_lbe-DgFovF2ZDY4au-PtXtfhPomEc',
            'https://fastly.picsum.photos/id/301/640/480.jpg?hmac=cuhrqpZX9_TNrx5v0KLmx8EvVPwAI5XDw6prbT2Vz4o',
            'https://fastly.picsum.photos/id/307/640/480.jpg?hmac=DcJ-SvlWvCs2J-UhNzkFr7okLTXNOE6Q0F0jSgxAt5k',
            'https://fastly.picsum.photos/id/252/640/480.jpg?hmac=EdLlBbqXr5ktejvnPMcCmAXVKMOxb4HtMNFM2uM2hPE',
            'https://fastly.picsum.photos/id/431/640/480.jpg?hmac=pW4oq1b201VMBDpRcIsTrFs18H3lniXlwmpua9skKx0',
            'https://fastly.picsum.photos/id/355/640/480.jpg?hmac=ZEB01kUr3WIr1c6_1awdHcevf4f9HnzDqwBpzg_7ipw',
            'https://fastly.picsum.photos/id/789/640/480.jpg?hmac=FTT2lrDSJb3hZ17uzCl4JxCX1yu2uBSA8-VT4JBEL-M',
            'https://fastly.picsum.photos/id/101/640/480.jpg?hmac=Sq7J7E5fjmSmB-ku-0By0s-SsTlkaHCOdjbJ07_olds',
            'https://fastly.picsum.photos/id/204/640/480.jpg?hmac=M8wYMGD_83fj3ZxaFRGj8dFRlIZE-0NKjQwhpmQwiwI',
            'https://fastly.picsum.photos/id/373/640/480.jpg?hmac=ZXgzKmqVwHFErJAJ2NRVRBwt9iB-PHQviUNaypjnwZE',
            'https://fastly.picsum.photos/id/328/640/480.jpg?hmac=pxDZGikUKOyqZqwxvvQYKyGbqGEqWlmq1NNGvj9ySjM',
            'https://fastly.picsum.photos/id/1018/640/480.jpg?hmac=2YhfYZxRtf_S8R4cSRNCc8nmApdvPLtddbF7AqtKnIc',
            'https://fastly.picsum.photos/id/883/640/480.jpg?hmac=w460-jxsEery6JEYMFjqigSUvGuGNObMbBqrUpMF03E',
            'https://fastly.picsum.photos/id/998/640/480.jpg?hmac=48fmzVnIEFULedfwBnagYvcjZjeAeMKGXGi9KabZRkg',
            'https://fastly.picsum.photos/id/405/640/480.jpg?hmac=-IHn-xliW7wFphv1K2qmuJ31AmnJv0kS3oGad3rrRos',
            'https://fastly.picsum.photos/id/65/640/480.jpg?hmac=XTuLGIHxxrQnEBEaSDKoWToOmF-uQ-Q1PvnjQwTlk0s',
            'https://fastly.picsum.photos/id/695/640/480.jpg?hmac=Ro0h-pgXZxne9Bf-Gk7317gdrbMVYwUziho6D-FkPzs',
            'https://fastly.picsum.photos/id/1027/640/480.jpg?hmac=NHLxcKE0o4VFr9zkbv_oSPFohtMBsOZfPmdXQeIo8SM',
            'https://fastly.picsum.photos/id/187/640/480.jpg?hmac=IKSzu7B1lxSQ8sKURlYOh-xEx2_2BseZnALC7ACvpbU',
            'https://fastly.picsum.photos/id/964/640/480.jpg?hmac=xvAHO0B2XiwgYywuOJSQVT7-w1o2fm1_d6K8Hlc9k_4',
            'https://fastly.picsum.photos/id/17/640/480.jpg?hmac=ou83RWKqpe4sBArkuDbzUL1deSOTlJo0r3dugmGbVzk',
            'https://fastly.picsum.photos/id/91/640/480.jpg?hmac=qLY9YW2b5Aqqlfo2wThbQLqfkvVrpyRhIupBBcTmmgo',
            'https://fastly.picsum.photos/id/89/640/480.jpg?hmac=ilKbgofai48UYqQQ8PG1DJhzHYTFoZQiGKCYHZwDyUU',
            'https://fastly.picsum.photos/id/227/640/480.jpg?hmac=0sLAgfWJS1WsitBZar_H2QDRSTngWaIhlRrQnpUkwQ0',
            'https://fastly.picsum.photos/id/47/640/480.jpg?hmac=r887p2xkkA_3BDrHcymvkB2ZZ6uEI7Qdi1eK8mOa72c',
            'https://fastly.picsum.photos/id/921/640/480.jpg?hmac=T6PsxILwlNvbErn8em4oe85n7zvPYc_udkWAuZbDNoM',
            'https://fastly.picsum.photos/id/2/640/480.jpg?hmac=DRKBBndo8Tfkppn4AbfwllAGf-Tr0io_l-IrBeGVBKM',
            'https://fastly.picsum.photos/id/476/640/480.jpg?hmac=AajcUEOGGomrT2XRmuoC5qo8QYHGB6Ur2CvYSXKTkOg',
            'https://fastly.picsum.photos/id/56/640/480.jpg?hmac=iZranOmRbg7rTM-eUzsK7HjOxCGJyCq6PBlwWoIOTdc',
            'https://fastly.picsum.photos/id/1078/640/480.jpg?hmac=AWyYpZM1TMIBU4GkNVU00YQDixss_2ltK0KeFE5WirE',
            'https://fastly.picsum.photos/id/265/640/480.jpg?hmac=fvpvh3w5L5DtbaW-MCPtfc2L22QaTgEY0WA5Ail0oqE',
            'https://fastly.picsum.photos/id/795/640/480.jpg?hmac=m3xi4OhJ1Gp1cQ9iwYMQbBXP3sGwUmtps65qvMXG8mo',
            'https://fastly.picsum.photos/id/532/640/480.jpg?hmac=YVQC7AlkVepryqZ65r9SovbvGyxPdmPk6RWcgjzqq2k',
            'https://fastly.picsum.photos/id/844/640/480.jpg?hmac=ByW5apzOYt80rbptK59x1kuJ3P_i23kfy469yZMrgas',
            'https://fastly.picsum.photos/id/537/640/480.jpg?hmac=Db2ulse6qxBDzgmjrsSL84tu_Ieq9mGXn1PA3svxKmE',
            'https://fastly.picsum.photos/id/486/640/480.jpg?hmac=oU-I-f5X66Ayln4aCq3wvuHxvGrXX1yS6Idtc7UAJPE',
            'https://fastly.picsum.photos/id/14/640/480.jpg?hmac=JBy9aU0REWUECfbVic8Bwhz22yA2XqTwaP6DXK5gg3Y',
            'https://fastly.picsum.photos/id/13/640/480.jpg?hmac=xKIT6KAaP0yS_eWmmSib0_LBFOhYaGURBhlMA-Vlumw',
            'https://fastly.picsum.photos/id/323/640/480.jpg?hmac=HctSYiG7CtTNcIeHht0_FbeNgp7qCPu7t5JzATuARDY',
            'https://fastly.picsum.photos/id/10/640/480.jpg?hmac=wnXx9hTuCl7hrnf7bCtb-2zV3aveFJws6i11pwy5z08',
            'https://fastly.picsum.photos/id/330/640/480.jpg?hmac=APDWE-l0xDVDcKYQDrS4sW8TOoKJ6gsOfgsEgfkoVx8',
            'https://fastly.picsum.photos/id/416/640/480.jpg?hmac=QqXRwVsFcVlllCZqNvIB562qP3rlWQoZCq9ULdcaGZ4',
            'https://fastly.picsum.photos/id/716/640/480.jpg?hmac=blgQIDC98rqRhSgUSyxlnLByEQ8O0L-XlyEixGzkK7M',
            'https://fastly.picsum.photos/id/915/640/480.jpg?hmac=ETacBz00XHMIhLUjfpgsbcTc1ZkjIYVwwlQEZAvHmZc',
            'https://fastly.picsum.photos/id/443/640/480.jpg?hmac=K2Li8il1XxYUbG9lU6ItuUzel-kUidGfk6QMLlDrCtE',
            'https://fastly.picsum.photos/id/939/640/480.jpg?hmac=JP8RYUBvj-mZtZ3gjW6kTO3nI0MCNOZgIgCR0Bxbkmo',
            'https://fastly.picsum.photos/id/357/640/480.jpg?hmac=x8xQVS8BIaGbsdONZuqyvrse6VXb_UOS5Ml2DNUBcPU',
        ];
    }
}
