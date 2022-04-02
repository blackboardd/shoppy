import Navbar from '@/features/navbar/components';

/**
 * Product add form component.
 * 
 * This component will be in charge of displaying a form with the id
 * #product_form. It will contain the following fields:
 * SKU (id: #sku)
 * Name (id: #name)
 * Price (id: #price)
 * Product type switcher (id: #productType) with following options:
 *   DVD (can be value or text)
 *   Book (can be value or text)
 *   Furniture (can be value or text)
 * Product type-specific attribute
 *   Size input field (in MB) for DVD-disc should have an ID: #size
 *   Weight input field (in Kg) for Book should have an ID: #weight
 *   Each from Dimensions input fields (HxWxL) for Furniture should
 *     have an appropriate ID:
 *     Height - #height
 *     Width - #width
 *     Length - #length
 */
const ProductAddForm = (): JSX.Element => {
  return (
    <div className="container">
      <div className="row">
        <div className="col-md-6 offset-md-3">
          <form id="product_form">
            <div className="form-group">
              <label htmlFor="sku">SKU</label>
              <input type="text" className="form-control" id="sku" />
            </div>
            <div className="form-group">
              <label htmlFor="name">Name</label>
              <input type="text" className="form-control" id="name" />
            </div>
            <div className="form-group">
              <label htmlFor="price">Price</label>
              <input type="text" className="form-control" id="price" />
            </div>
            <div className="form-group">
              <label htmlFor="productType">Product Type</label>
              <select className="form-control" id="productType">
                <option>DVD</option>
                <option>Book</option>
                <option>Furniture</option>
              </select>
            </div>
            <div className="form-group">
              <label htmlFor="size">Size</label>
              <input type="text" className="form-control" id="size" />
            </div>
            <div className="form-group">
              <label htmlFor="weight">Weight</label>
              <input type="text" className="form-control" id="weight" />
            </div>
            <div className="form-group">
              <label htmlFor="height">Height</label>
              <input type="text" className="form-control" id="height" />
            </div>
            <div className="form-group">
              <label htmlFor="width">Width</label>
              <input type="text" className="form-control" id="width" />
            </div>
            <div className="form-group">
              <label htmlFor="length">Length</label>
              <input type="text" className="form-control" id="length" />
            </div>
            <button type="submit" className="btn btn-primary">
              Save
            </button>
            <button type="button" className="btn btn-secondary">
              Cancel
            </button>
          </form>
        </div>
      </div>
    </div>
  );
};

export default ProductAddForm;
