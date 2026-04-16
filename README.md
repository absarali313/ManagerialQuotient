# Contribution Guidelines

Thank you for considering contributing to the project. Here are some guidelines to help you get started!

## Table of Contents

1. [Naming Conventions](#naming-conventions)
    - [Branch Naming Conventions](#branch-naming-conventions)
        - [New Feature](#new-feature)
        - [GitHub Issue Branch Names](#github-issue-branch-names)
    - [Variable and Function Names](#variable-and-function-names)
        - [Method Naming Guidelines](#method-naming-guidelines)
        - [Constant Variables](#constants-variables)
        - [PHP Classes (Controllers, Models, Components)](#php-classes-controllers-models-components)
        - [Boolean Variable Names](#boolean-variable-names)
        - [Events Naming Convention](#events-naming-convention)
    - [Directory Names Conventions](#directory-names-conventions)
        - [View Directories](#view-directories)
        - [Directories for Actions or Classes](#directories-for-actions-or-classes)
    - [Database Naming](#database-naming)
        - [Migration Files](#migration-files)
        - [Table Names](#table-names)
        - [Attribute Names](#attribute-names)
    - [Route Naming Conventions for Admin Panel](#route-naming-conventions-for-admin-panel)
    - [Livewire Components Naming](#livewire-component-naming-conventions)
        - [Index Page](#index-page)
        - [Create Page](#create-page)
        - [Edit Page](#edit-page)
        - [Unified Create and Edit Page](#unified-create-and-edit-page)
        - [Show/View Page](#showview-page)
2. [Code Structure Guidelines](#code-structure-guidelines)
    - [Controller Actions Order](#controller-actions-order)
    - [Invokable Controllers for Abnormal Actions](#invokable-controllers-for-abnormal-actions)
    - [Livewire Components](#livewire-components)
    - [Sort Order Attribute](#sort-order-attribute)
    - [Action Handling Guidelines](#action-handling-guidelines)
        - [Unified Save Action for Store & Update](#unified-save-action-for-store-and-update)
        - [Parameters Sequence in Action Handler](#parameters-sequence-in-action-handler)
        - [DocBlock Standards for Data Formatting Actions](#docblock-standards-for-data-formatting-actions)
        - [How to Call an Action](#how-to-call-an-action)
3. [Queries Best practices](#query-best-practices)
    - [Use of whereAny](#use-of-whereany)
    - [Use of whereLike](#use-of-wherelike)
4. [String Interpolation](#string-interpolation)
    - [Preferred Interpolation Method](#preferred-interpolation-method)
    - [Deprecated Syntax](#deprecated-syntax)
5. [Type Hinting and Return Types](#type-hinting-and-return-types)
    - [Variable and Property Type Hinting](#variable-and-property-type-hinting)
    - [Function Return Types](#function-return-types)
6. [Formatting Guidelines](#formatting-guidelines)
    - [Editor Formatting](#editor-formatting)
    - [Running Pint](#running-pint)

## Naming Conventions

When creating branches, please follow these naming conventions:

### Branch Naming Conventions
Since multiple projects are active, all branch names must include the **project abbreviation** in addition to the author and task. This ensures clarity about which project a branch belongs to.

#### Format

```plaintext
<author_first_name>/<project_abbreviation>/<type_of_issue>/<three_word_task>
```

- **author:** Your name or identifier
- **project_abbreviation:** The predefined abbreviation for the project (MR in this case)
- **type_of_issue:** `feature`, `update`, `hotfix`, `refactor`
- **taskwords:** Three descriptive words for the task, separated by hyphens

**Example:**

- For a feature: `absar/mr/feature/update-admin-cart`

#### GitHub Issue Branch Names

When creating branches for GitHub issues, please follow this naming convention:

```
<author_first_name>/<project_abbreviation>/<type>/<github_id>-<three-keyword-task>
```

- **github_id:** The GitHub issue ID

**Example:**

- For a hotfix: `absar/mr/hotfix/123-fix-login-issue`

### Variable and Function Names

#### Method Naming Guidelines

Use method names that clearly describe the **underlying PHP logic**.

If you can’t name a method **clearly and concisely**, the method might be doing too much and should be **refactored into
smaller parts**.

---

#### Do

- Choose short, descriptive names that eliminate the need for a simple DocBlock:

```php
  public function isActive(): bool
  public function calculateDiscount(): float
  public function formatPhoneNumber(): string
  public function sendWelcomeEmail(): void
  // These method names make DocBlocks redundant because the name clearly states what the method does.
```

#### Don't

- Use vague or overly long names:

```php
public function checkIfUserIsActiveAndEligibleForDiscountBasedOnCriteria() // ❌ Too long
public function handle()                                                   // ❌ Too vague
```

- Rely on a DocBlock to explain what a poorly named method does:

```php
/**
 * Returns true if the user is active
 */
public function statusCheck() // ❌ Name doesn't reflect the logic
```

#### *Tip*:

````
💡 Tip: A good method name reduces the need for basic DocBlocks and improves code readability, and usability - especially when interacting with the method away from the declaration. If your method needs a comment to be understood, consider renaming and/or refactoring.
````

#### Constants Variables

Use `SCREAMING_SNAKE_CASE` for constant variable names.

- **Do:**
    - Use `SCREAMING_SNAKE_CASE` for constant names:
      ```php
      public const DISTRICT_ADMIN_ROLE_ID = 41;
      private const MAX_RETRY_ATTEMPTS = 3;
      ```

- **Don't:**
    - Use `camelCase`, `PascalCase`, or `snake_case` for constants:
      ```php
      public const districtAdminRoleId = 41;  // Incorrect
      private const max_retry_attempts = 3;   // Incorrect
      ```

#### PHP Classes (Controllers, Models, Components)

Use `camelCase` for variables and function names in PHP classes like controllers, models, and Livewire components.

- **Do:**
    - Use `camelCase` for variable and function names in PHP classes:
      ```php
      public $userName;  // camelCase
      protected function calculateTotal() {}  // camelCase
      ```

- **Don't:**
    - Use `snake_case` or mixed conventions within PHP classes:
      ```php
      public $user_name;  // Incorrect
      protected function calculate_total() {}  // Incorrect
      ```

#### Boolean Variable Names

Using consistent naming conventions for boolean variables makes the code more readable and helps clarify the expected
values. Boolean variables should usually start with `is`, `can`, or `has`.

- **Do:**
    - Use clear names for standard boolean variables:
      ```php
      public bool $isActive;
      public bool $hasPermission;
      
      public function canBeDeleted(): bool
      {
      ...
      }
      ```

- **Don't:**
    - Use ambiguous or unclear names for boolean variables:
      ```php
      public bool $active;  // Unclear intent
      ```

### Events Naming Convention

All **JavaScript** and **Livewire** event names must use **kebab-case** to maintain consistency and follow best
practices.

- **Do:**

```php
  $this->dispatch('cart-item-added');
  window.dispatchEvent(new CustomEvent('user-logged-in'));
```

- **Don't:**

```php
  $this->dispatch('cartItemAdded');
  window.dispatchEvent(new CustomEvent('user_logged_in'));
```

### Directory Names Conventions

Directory naming conventions should be based on their purpose and follow a specific pattern to ensure clarity and
uniformity across the codebase.

#### View Directories

View directories should always be lowercase.

- **Do:**
    - Use lowercase for all directory names related to views:
      ```plaintext
      views/admin/dashboard
      ```

- **Don't:**
    - Use mixed case or uppercase in view directories:
      ```plaintext
      views/Admin/dashboard  // Incorrect
      ```

#### Directories for Actions or Classes

Directories containing actions, models, controllers or other PHP classes should use PascalCase.

- **Do:**
    - Use PascalCase for directories containing actions or classes:
      ```plaintext
      App/Actions/UserActions
      ```

- **Don't:**
    - Use lowercase or inconsistent casing for directories containing PHP classes or actions:
      ```plaintext
      app/actions/userActions  // Incorrect
      ```

#### *Production Note*:

💡 Tip: Production servers (typically Linux) usually rely on exact case matches being used, unlike most developer
devices (typically macOS). If `This/Directory/structure.jpg` is created, calling `this/directory/structure.jpg` may work
in development but will fail in production.

### Database Naming

#### Migration Files

- **Do:**
    - Use `snake_case` for migration file names:
      ```plaintext
      create_user_profiles_table.php  // snake_case
      ```

- **Don't:**
    - Use `camelCase` or inconsistent casing in migration file names:
      ```plaintext
      createUserProfilesTable.php  // Incorrect
      ```

#### Table Names

##### Usual Table Names in Laravel

- **Do:**
    - Use `snake_case` for table names and always choose **plural** nouns.
    - The table name should correspond to the plural form of the associated model name.
      ```plaintext
      Model: ProductCategory → Table: product_categories
      Model: OrderItem → Table: order_items

      ```

- **Don't:**
    - Use `camelCase` or **singular** forms for table names.
      ```plaintext
      Model: ProductCategory → ProductCategories  // Incorrect, camelCase
      Model: OrderItem → Table: order_item        // Incorrect, singular
      ```

#### Scoping Table Names and Models

Avoid **generic or ambiguous table names** like `slots`, which don’t convey their purpose clearly.

Instead, use **meaningful names** that represent the context or feature being modeled.  
This also applies to **model names**, as they should reflect the specific purpose of the resource.

**Correct Example:**

- **Model:** `HeroBannerSlot`
- **Table:** `hero_banner_slots`

**Incorrect Example:**

- **Model:** `Slot`
- **Table:** `slots`

Read more details here: [Database table naming convention](https://laravel.com/docs/11.x/eloquent#table-names)

##### Pivot Table Names for Many-to-Many Relationships

- **Do:**
    - Use **singular** table names in `snake_case` for pivot tables, ordered alphabetically by model names, and
      separated by an underscore.
      ```plaintext
      Models: Product and Tag → Pivot Table: product_tag
      Models: Role and User → Pivot Table: role_user
      ```

- **Don't:**
    - Use **plural** names or deviate from the alphabetical order:
      ```plaintext
      products_tags  // Incorrect, plural
      user_role      // Incorrect, not alphabetical
      ```

Read more details here: [Pivot tables structure](https://laravel.com/docs/11.x/eloquent-relationships#many-to-many)

#### Attribute Names

- **Do:**
    - Use `snake_case` for column names in the database:
      ```plaintext
      user_id
      product_name
      ```

- **Don't:**
    - Use `camelCase` or inconsistent casing for column names:
      ```plaintext
      userId        // Incorrect, camelCase
      ProductName   // Incorrect, PascalCase
      ```

- **Do:**
    - Use consistent naming conventions for foreign keys:
      ```plaintext
      product_category_id  // Refers to product_categories table
      ```

- **Don't:**
    - Use ambiguous or shortened names for foreign keys:
      ```plaintext
      categoryID  // Incorrect, ambiguous casing
      ```

### Route Naming Conventions for Admin Panel

When defining routes in the admin panel, follow these conventions:

- **Use `snake_case`:** Ensure the route names are written in `snake_case` for consistency.

- **Prefix with `admin_`:** All admin routes should be prefixed with  `admin_`.

- **Plural for collections:** Use plural names when referring to a collection of resources.

- **Singular for specific resources:** Use singular names when referring to a specific resource or action on a single
  item.

#### Example:

```php
Route::middleware('role:63')->controller(Admin\JobListings\JobListingController::class)->group(function () {
    Route::get('job-listings', 'index')->name('admin_job_listings');  // Plural
    Route::get('job-listings/create', 'create')->name('admin_job_listing_create');  // Singular
    Route::post('job-listings', 'store')->name('admin_job_listing_post');  // Singular
    Route::get('job-listings/{job_listing}/edit', 'edit')->name('admin_job_listing_edit');  // Singular
    Route::patch('job-listings/{job_listing}', 'update')->name('admin_job_listing_update');  // Singular
    Route::delete('job-listings/{job_listing}', 'destroy')->name('admin_job_listing_delete');  // Singular
});
```

### Livewire Component Naming Conventions

When defining Livewire components, adhere to the following naming conventions to ensure consistency and maintainability
across the project:

#### Index Page

- **Naming Format:** `EntityIndex`
- **Examples:** `FaqIndex`, `ProductCategoryIndex`
- **Purpose:** This component is responsible for listing multiple instances of a given entity. It typically includes
  functionalities such as filtering, searching, and pagination to enhance user interaction with the data.

#### Create Page

- **Naming Format:** `EntityCreate`
- **Examples:** `FaqCreate`, `ProductCategoryCreate`
- **Purpose:** This component facilitates the creation of new entities. It provides a form for users to input data and
  submit it for storage.

#### Edit Page

- **Naming Format:** `EntityEdit`
- **Examples:** `FaqEdit`, `ProductCategoryEdit`
- **Purpose:** This component is designed for editing existing entities. It provides a form pre-filled with the entity's
  current data, allowing users to make updates.

#### Unified Create and Edit Page

- **Naming Format:** `EntitySave`
- **Examples:** `FaqSave`, `ProductCategorySave`
- **Purpose:** This component consolidates the creation and editing functionalities into a single interface. It manages
  form input, validation, and save operations for both new and existing entities.

#### Show/View Page

- **Naming Format:** `EntityShow`
- **Examples:** `FaqShow`, `ProductCategoryShow`
- **Purpose:** This component displays the details of a specific entity. It is often used to show information after an
  entity is selected from the index page.

## Code Structure Guidelines

### Controller Actions Order

Adhere to the following order for methods in controllers. Do not arrange them alphabetically:

- `index`
- `show`
- `create`
- `store`
- `edit`
- `update`
- `destroy`

### Invokable Controllers for Abnormal Actions

For controller actions that don’t fit the standard RESTful patterns—such as **Download**, **Preview**, or **Export**—you should use [Invokable Controllers](https://laravel.com/docs/controllers#single-action-controllers). This keeps controller responsibilities focused and maintains clarity in route definitions.

- **Do:**
    - Create a dedicated invokable controller for abnormal or standalone operations:
      ```bash
      php artisan make:controller DownloadInvoice --invokable
      ```

    - Define the route using the controller class directly:
      ```php
      Route::get('invoices/{invoice}/download', DownloadInvoice::class)->name('admin_invoice_download');
      ```

    - Example controller:
      ```php
      namespace App\Http\Controllers\Admin\Invoices;

      use App\Http\Controllers\Controller;
      use App\Models\Invoice;
      use Illuminate\Support\Facades\Response;

      class DownloadInvoice extends Controller
      {
          public function __invoke(Invoice $invoice)
          {
              $pathToFile = storage_path("app/invoices/{$invoice->file_name}");

              return Response::download($pathToFile, $invoice->file_name);
          }
      }
      ```

- **Don't:**
    - Add unrelated methods like `download()` or `export()` inside resource controllers such as `InvoiceController`:
      ```php
      // Avoid this:
      public function download(Invoice $invoice) {
          // Not ideal for non-RESTful actions
      }
      ```

> ✅ **Tip:** If an action cannot clearly be categorized as `index`, `show`, `store`, `update`, etc., it likely deserves its own invokable controller.


### Livewire Components

For security concerns with Livewire components, please review and understand the relevant security documentation to
ensure safe practices. You can find the Laravel security guide
here: [Livewire Security Documentation](https://livewire.laravel.com/docs/security#authorizing-action-parameters).

### Sort Order Attribute

To maintain consistency across the application, all models that support sorting must include an integer column named
`sort_order` in their respective database tables. This column will be used to define the sort sequence and must begin
with the value 1. Avoid using alternative column names such as order or index to ensure uniformity and prevent potential
conflicts.

### Action Handling Guidelines

#### Unified Save Action for Store and Update

When using the same save action for both store and update controller actions, use the following guidelines:

1. **Use a default parameter for passing the object instance in the `store` action.**
    - This way, the object instance doesn’t need to be passed explicitly from the store method. The object instantiation
      parameter will only be passed for the `update` method.

- **Do** :

```php
public function handle(array $data, FaqCategory $category = new FaqCategory()): FaqCategory {
    // logic for handling save
}

public function store(FaqCategoryRequest $request, SaveFaqCategory $saveFaqCategory) {
    $category = $saveFaqCategory->handle($request->validated());
    // logic for store action
}

public function update(FaqCategoryRequest $request, FaqCategory $faq_category, SaveFaqCategory $saveFaqCategory) {
    $saveFaqCategory->handle($request->validated(), $faq_category);
    // logic for update action
}
```

Notice the number of parameters passed to `$saveFaqCategory->handle` for `store` and `update` actions are different.

- **Dont :**

```php
public function handle(array $data, FaqCategory $category): FaqCategory {
    // Incorrect way of defining handle method, object instantiation should be default for store
}

public function store(FaqCategoryRequest $request, SaveFaqCategory $saveFaqCategory) {
    $category = new FaqCategory(); // Object instantiation should be part of the handle method, not here
    $saveFaqCategory->handle($request->validated(), $category);
    // logic for store action
}
```

In this scenario, the `$category` parameter had to be passed to `$saveFaqCategory->handle` which is incorrect.

#### Parameters Sequence in Action Handler

When defining action parameters for a validated data array and an object instance:

- `Request` data array should come first (e.g., `$data`).
- Optional object instance should be placed at end (e.g., $faq), ensuring required parameters precede optional ones.


- **Do :**

```php
public function handle(array $data, Faq $faq = new Faq()): Faq {
    // Correct order: data first, object last
}
```

- **Don't :**

```php
public function handle(Faq $faq, array $data): Faq {
    // Incorrect: object before data
}
```

#### DocBlock Standards for Data Formatting Actions

When writing Action classes that format or transform data, you **must** document:

- The **input type** and expected format
- The **output type** and resulting format
- A **clear description** of the transformation being done

This ensures that actions are self-documenting, predictable, and easy to reuse across the application.

---

#### ✅ Standard DocBlock Template

```php
/**
 * [Brief explanation of the transformation being performed.]
 *
 * @param  Type  $inputVariable  [Expected format or structure of the input]
 * @return Type                  [Expected format or structure of the output]
 */
public function handle(Type $inputVariable): Type
```

#### Example

```php
/**
     * Formats a collection of dates into a readable date range string.
     *
     * The method groups dates by month and formats them as consecutive
     * day ranges where possible, combining them into a human-readable string.
     *
     * Example Input:
     * Collection of Carbon dates:
     * [
     *    2025-03-01,
     *    2025-03-02,
     *    2025-04-10,
     *    2025-04-11,
     * ]
     *
     * Example Output:
     * "March 1-2; April 10-11, 2025"
     *
     * @param Collection $dates A collection of Carbon date instances.
     */
    public function handle(Collection $dates): string
    {
        if ($dates->isEmpty()) {
            return '';
        }

        $datesByMonth = $this->groupDatesByMonth($dates);
        $formattedRanges = $this->formatDateRanges($datesByMonth);

        return implode('; ', $formattedRanges) . ', ' . $dates->first()->format('Y');
    }
```

#### How to Call an Action

When using Action classes, follow a consistent pattern based on where the action is being used.

#### ✅ In Controllers – Use Dependency Injection

Inject the action class directly into the controller method or constructor.

```php
use App\Actions\User\TransformUserPayload;

public function store(Request $request, TransformUserPayload $transformUserPayload)
{
    $data = $transformUserPayload->handle($request->all());
    // Further logic...
}
```

#### ✅ In Models or Livewire Components – Use resolve() Helper

Use Laravel’s resolve() helper to resolve and call the action class.

```php
use App\Actions\User\TransformUserPayload;

$data = resolve(TransformUserPayload::class)->handle($rawData);
```

#### ❌ Don’t: Call Actions Statically

Avoid calling actions using static method syntax. It breaks the service container, makes testing harder, and goes
against Laravel conventions.

```php
$data = TransformUserPayload::handle($rawData);
```

## Query Best Practices

### Use of whereAny

Use `whereAny` when checking multiple columns for the same condition instead of chaining `where` and `orWhere`.

- **Do:**
    - Use `whereAny` for cleaner, more readable queries:
      ```php
      $query->whereAny([
          'first_name',
          'last_name',
          'email',
      ], 'like', '%john%');
      ```

- **Don't:**
    - Chain multiple `where` and `orWhere` clauses manually:
      ```php
      $query->where('first_name', 'like', '%john%')
            ->orWhere('last_name', 'like', '%john%')
            ->orWhere('email', 'like', '%john%');  // Incorrect
      ```

### Use of whereLike

Use `whereLike` when performing `LIKE` queries on a single or nested column, instead of manually writing `where` with
`like`.

- **Do:**
    - Use `whereLike` for cleaner and more expressive syntax:
      ```php
      $query->whereLike('email', '%@example.com%');
      
      $query->whereLike('user.name', '%john%');
      ```

- **Don't:**
    - Use raw `where` with `like` manually:
      ```php
      $query->where('email', 'like', '%@example.com%');  // Incorrect
      $query->where('user.name', 'like', '%john%');       // Incorrect
      ```

## String Interpolation

String interpolation in PHP should use modern practices to avoid deprecated syntax and improve readability.

### Preferred Interpolation Method

Directly place variables inside double-quoted strings for a clear and straightforward approach.

- **Do:**
    - Use the preferred string interpolation method:
      ```php
      $name = 'PHP';
      echo "Hello $name";
      ```

### Deprecated Syntax

Avoid deprecated syntax to ensure compatibility and follow
the [PHP 8.2 documentation](https://php.watch/versions/8.2/$%7Bvar%7D-string-interpolation-deprecated).

- **Don't:**
    - Use deprecated string interpolation:
      ```php
      echo "Hello ${name}"; // Deprecated
      ```

## Type Hinting and Return Types

Adding type hinting and return types enhances code predictability and readability.

### Variable and Property Type Hinting

Define data types for variables and properties to make the code more predictable and easier to understand.

- **Do:**
    - Specify data types for variables and public properties:
      ```php
      public string $userName;
      ```

- **Don't:**
    - Leave variables without a defined data type:
      ```php
      public $userName;  // Missing data type
      ```

### Function Return Types

Always define return types for functions to clarify the expected output type.

- **Do:**
    - Specify the return type for functions:
      ```php
      public function getUserName(): string {
          return $this->userName;
      }
      ```

- **Don't:**
    - Leave function return types undefined:
      ```php
      public function getUserName() {  // Missing return type
          return $this->userName;
      }
      ```

## Formatting Guidelines

### Editor Formatting

When using editors like TinyMCE, ensure root block elements are excluded to maintain proper content formatting. For
example, use parameters like `forced_root_block: false` to prevent the automatic wrapping of content in `<p>` tags.

### Running Pint

Format files with Pint to ensure consistent styling, focusing on files directly related to your PR.

- **Do:**
    - Run Pint on relevant files before committing:
      ```plaintext
      ./vendor/bin/pint
      ```
